<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;

class JalaliDate implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value ? Jalalian::fromCarbon(Carbon::parse($value))->format('Y/m/d') : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        // اگر مقدار ورودی تاریخ شمسی بود، تبدیلش کن به میلادی
        try {
            [$year, $month, $day] = explode('/', $value);
            return Jalalian::fromFormat('Y/m/d', $value)->toCarbon()->toDateString();
        } catch (\Exception $e) {
            return $value; // در صورت مشکل، مقدار خام رو برگردون
        }
    }
}
