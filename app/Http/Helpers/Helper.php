<?php


use App\Models\Language;

if (!function_exists('assetURLFile')) {
    function assetURLFile($filename)
    {
        return asset('/uploads/'. $filename);
    }
}

if (!function_exists('StrLimit')) {
    function strLimit($attribute, $limit)
    {
        return \Illuminate\Support\Str::limit($attribute, $limit, $end='...');
    }
}

if (!function_exists('days')) {
    function days()
    {
        $timestamp = strtotime('next Sunday');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        return $days;
    }
}




if (!function_exists('currentLanguage')) {
    function currentLanguage()
    {
        return app()->getLocale();
    }
}
if (!function_exists('getLanguageId')) {
    function getLanguageId()
    {
        $id = Language::whereCode(currentLanguage())->first();
        return $id ? $id->id : 0;
    }
}

if (!function_exists('translateColumn')) {
    function translateColumn($con, $col)
    {
        return (count($con->translations) > 0) ? $con->translations[0]->$col : '';
    }
}


