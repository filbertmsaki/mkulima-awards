<?php

use App\Enums\EventStatusEnum;
use App\Models\EventSetting;
use Carbon\Carbon;
use Illuminate\Support\Str;




if (!function_exists('award_registration_period')) {
    function award_registration_period()
    {
        $award_registration = EventSetting::where('value', 'award_registration')->first();
        $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $award_registration->start_date);
        $end_date = Carbon::createFromFormat('Y-m-d H:i:s',  $award_registration->end_date);
        $now = Carbon::createFromFormat('Y-m-d H:i:s',  Carbon::now());
        $start = $start_date->lt($now);
        $end = $now->lt($end_date);
        $status =   $award_registration->status->value;
        if ($start &&  $end && $status == EventStatusEnum::Active->value) {
            $result = true;
        } else {
            $result = false;
        }
        return    $result;
    }
}


if (!function_exists('voting_period')) {
    function voting_period()
    {
        $voting = EventSetting::where('value', 'voting')->first();
        $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $voting->start_date);
        $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $voting->end_date);
        $now = Carbon::createFromFormat('Y-m-d H:i:s',  Carbon::now());
        $start = $start_date->lt($now);
        $end = $now->lt($end_date);
        $status =  $voting->status->value;
        if ($start &&  $end && $status == EventStatusEnum::Active->value) {
            $result = true;
        } else {
            $result = false;
        }
        return    $result;
    }
}




if (!function_exists('random_color')) {
    function random_color()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}

if (!function_exists('remove_space')) {
    function remove_space($string)
    {
        return str_replace(' ', '-', $string);
    }
}
if (!function_exists('remove_special_characters')) {
    function remove_special_characters($string)
    {
        $characters = str_replace(array(
            '\'', '"', '(', ')', '[', ']', '/', '+', '=', '$', '@',
            ',', ';', '<', '>', ':', '!', '#', '%', '^', '*', '~', '|', '{', '}', '.',
        ), '', $string);
        $word = str_replace('_', ' ', $characters);
        $result = strtolower(preg_replace('/-+/', '-', remove_space(str_replace('&', 'and', $word))));
        return $result;
    }
}
if (!function_exists('unique_token')) {
    function unique_token()
    {
        $string = Str::random(10);
        return md5($string . time());
    }
}

if (!function_exists('numberFormat')) {
    function numberFormat($number, $point = 0)
    {
        return number_format($number, $point, '.', ',');
    }
}
if (!function_exists('clear')) {
    function clear($string)
    {
        $string = preg_replace('/\s+/', ' ', $string);
        $string = preg_replace('/[^A-Za-z0-9-& ]/', '', $string);
        $string = preg_replace('/-+/', '-', $string);
        $string = trim($string);
        return $string;
    }
}
if (!function_exists('unique_slug')) {
    function unique_slug($string)
    {
        $string = clear($string);
        $string = remove_special_characters($string);
        $string = strtolower($string);
        return $string;
    }
}

if (!function_exists('lowercase')) {
    function lowercase($string)
    {
        $string = preg_replace('/\s+/', ' ', $string);
        $string = trim($string);
        $string = strtolower($string);
        return $string;
    }
}
if (!function_exists('uppercase')) {
    function uppercase($string)
    {
        $string = preg_replace('/\s+/', ' ', $string);
        $string = trim($string);
        $string = strtoupper($string);
        return $string;
    }
}

if (!function_exists('capitalize ')) {
    function capitalize($string)
    {
        $string = preg_replace('/\s+/', ' ', $string);
        $string = trim($string);
        $string = strtolower($string);
        $string = ucwords($string);
        return $string;
    }
}
