<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Table;
use App\Enums\TableStatus;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function stepOne(Request $request)
    {

        $reservation = $request->session()->get('reservation');

        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservations.step-one', compact('reservation', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'tel_number' => ['required'],
            'guest_number' => ['required'],
        ]);

        if (empty($request->session()->get('reservation'))) {
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        } else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }

        return to_route('reservations.step.two');
    }
    public function stepTwo(Request $request)
    {
        $reservation = $request->session()->get('reservation');
    
        if (!$reservation) {
            // Handle the case when the session data is not available
            // For example, redirect the user back to the form or display an error message
            return back()->with('error', 'Reservation data not found.');
        }
    
        $reservationDate = Carbon::parse($reservation->res_date);
    
        // Retrieve table IDs of existing reservations for the same date
        $reservedTableIds = Reservation::whereDate('res_date', $reservationDate)
            ->pluck('table_id');
    
        // Get available tables that are not reserved for the given date
        $availableTables = Table::where('status', TableStatus::Available)
            ->whereNotIn('id', $reservedTableIds)
            ->get();
    
        if ($availableTables->isEmpty()) {
            // No available tables for the given date
            return back()->with('warning', 'No available tables for the selected date');
        }
    
        return view('reservations.step-two', compact('reservation', 'availableTables'));
    }
    
    public function storeStepTwo(Request $request)
    {
        $validated = $request->validate([
            'table_id' => ['required']
        ]);
        $reservation = $request->session()->get('reservation');
        $reservation->fill($validated);
        $reservation->save();
        $request->session()->forget('reservation');

        return to_route('thankyou');
    }
}
