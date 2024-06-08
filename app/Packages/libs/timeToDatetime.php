<?php
use Carbon\Carbon;

if (!function_exists('tanggal')) {
    function tanggal($tanggal)
    {
        $tanggalCarbon = Carbon::parse($tanggal);
        return $tanggalCarbon->isoFormat('D MMMM Y');
    }
}
