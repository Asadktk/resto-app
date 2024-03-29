<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateBetween implements Rule
{
    public function passes($attribute, $value)
    {
        $pickupDate = Carbon::parse($value)->format('Y-m-d');
        $lastDate = Carbon::now()->addWeek();

        return $pickupDate >= now() && $value <= $lastDate;
    }

    public function message()
    {
        return 'Please choose the date between a week from now';
    }
}