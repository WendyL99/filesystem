<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 处理admin 表单中checkbox的值
 * @param $str
 * @param $options
 * @return string
 */
function parseCheckboxValue($checked, $options)
{
    //preg_match_all('/(\d+)/',$str,$match);
    $value_arr = array();
    foreach ($checked as $row){
        $value_arr[] = $options[$row];
    }
    return implode(',',$value_arr);
}
