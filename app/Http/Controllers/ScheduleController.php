<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index() {

        return view ('field/schedule');  
    }

    public static function calendar() {
        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);
        $startOfCalendar = $date->copy()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $date->copy()->endOfWeek(Carbon::SUNDAY);


        $html = '<div class="calendar">';
            
        while ($startOfCalendar <= $endOfCalendar) {
            $extraClass = $startOfCalendar->isToday() ? 'today' : '';

            $html .= '<div class="day '.$extraClass.'">';
            $html .= '<h2>' . $startOfCalendar->format('l jS F') . '</h2>';

            $html .= '</div>';
            $startOfCalendar->addDay();
        }

        $html .= '</div>';
        echo $html;
    }
}
