<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Validator;
use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status', TableStatus::Available)->get();
        return view('admin.reservations.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
  

    public function store(Request $request)
    {
        $table = Table::find($request->table_id);
    
        if ($table === null) {
            return back()->with('error', 'Invalid table');
        }
    
        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose a table based on the number of guests');
        }
    
        $request_date = Carbon::parse($request->res_date);
    
        if ($table->reservations !== null) {
            foreach ($table->reservations as $res) {
                if ($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
                    return back()->with('warning', 'This table is reserved for this date');
                }
            }
        }
    
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'tel_number' => 'required',
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'table_id' => 'required',
            'guest_number' => 'required'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        Reservation::create($request->all());
    
        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }
    
  
            /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', TableStatus::Available)->get();

        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $table = Table::findOrFail($request->table_id);

        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'please choose the table base on Guest');
        }

        $request_date = Carbon::parse($request->res_date);
        $reservations = $table->reservation()->where('id', '!=', $reservation->id)->get();
        foreach($reservations as $res){
            $resDate = Carbon::parse($res->res_date); // Convert the string to a DateTime object

            if($resDate->format('Y-m-d')  == $request_date->format('Y-m-d')){
                return back()->with('warning', 'This table is reserved for this date');
            }
        }

        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
            'tel_number' => 'required',
            'res_date' => 'required',
            'table_id' => 'required',
            'guest_number' => 'required'
        ]);

        $reservation->update($formFields);

        return redirect()->route('reservations.index')->with('success', 'Reservation Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('danger', 'Reservation deleted successfully');
    }
}
