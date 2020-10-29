<?php

use Illuminate\Support\Facades\DB;

function getAreaNameByCode($code)
{
    return DB::table('china_area')->where('code', $code)->value('name');
}
