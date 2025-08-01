<?php

namespace App\Services;

use App\Models\Course;
use DB;
use Illuminate\Support\Carbon;

class CourseService
{
    public static function percetageCompleted()
    {
        $total = DB::table('course_user')->count();
        $completed = DB::table('course_user')->where('status', 'completed')->count();

        return $total > 0 ? round(($completed / $total) * 100) : 0;
    }

    public static function durationHuman(Course $course)
    {
        if (!$course->start_date || !$course->end_date) {
            return null;
        }

        $start = Carbon::parse($course->start_date);
        $end = Carbon::parse($course->end_date);

        return $start->diffForHumans($end, [
            'syntax' => Carbon::DIFF_ABSOLUTE,
            'short' => false,
            'parts' => 2,
        ]);
    }

    public static function completeDate(Course $course)
    {
        
    }
}
