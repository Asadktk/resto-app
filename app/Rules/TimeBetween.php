<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TimeBetween implements Rule
{
    public function passes($attribute, $value)
    {
        $pickupDate = Carbon::parse($value);
        $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute, $pickupDate->second);

        //when the resturent is open
        $earliesTime = Carbon::createFromTimeString('01:00:00');
        $lastTime = Carbon::createFromTimeString('12:00:00');

        return $pickupTime->between($earliesTime, $lastTime) ? true : false;
    }

    public function message()
    {
        return 'Please choose the time between 1:00-12:00';
    }
}
