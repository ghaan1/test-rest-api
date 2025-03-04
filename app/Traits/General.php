<?php

namespace App\Traits;

use Carbon\Carbon;

trait General
{

    public function convertIndonesianDate($date)
    {
        return Carbon::parse($date)->translatedFormat('d F Y');
    }
}