<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Request $request, Course $course)
    {
        return $request->user()->checkout([
            $course->stripe_price_id => 1
        ], [
            'success_url' => route('courses.enroll.success', $course),
            'cancel_url' => route('courses.enroll.cancel', $course),
        ]);
    }

    public function success(Course $course)
    {
        $user = auth()->user();

        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            $user->enrolledCourses()->updateExistingPivot($course->id, [
                'registered_at' => now(),
            ]);
        } else {
            $user->enrolledCourses()->attach($course->id, [
                'registered_at' => now(),
            ]);
        }

        return view('courses.enroll.success');
    }

    public function cancel(Course $course)
    {
        return view('courses.enroll.cancel');
    }
}
