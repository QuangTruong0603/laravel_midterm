<?php
if (! function_exists('dateFormat')) {
    function dateFormat($date) {
        $options = ['year' => 'numeric', 'month' => 'short', 'day' => 'numeric'];
        return date_format(new DateTime($date), 'M d, Y');
    }
}

if (! function_exists('timeFormat')) {
    function timeFormat($time) {
        $time = date('H.i', strtotime($time));
        $hours = floor($time);
        $minutes = round(($time - $hours) * 60);
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}

if (! function_exists('totalSleepTime')) {
    function totalSleepTime($sleepTime, $wakeTime) {
        $sleepTime = date('H.i', strtotime($sleepTime));
        $wakeTime = date('H.i', strtotime($wakeTime));
        $sleepMins = round($sleepTime * 60);
        $wakeMins = round($wakeTime * 60);
        $diffMins = $wakeMins - $sleepMins;
        if ($diffMins < 0) {
            $diffMins += 1440;
        }
        $hours = floor($diffMins / 60);
        $minutes = $diffMins % 60;
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}

?>