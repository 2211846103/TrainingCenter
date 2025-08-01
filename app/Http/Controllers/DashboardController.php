<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        if (auth()->user()->hasRole('admin')) {

            $courses = Course::latest()->take(3)->get();
            $clients = Role::findByName('client')->users();
            $instructors = Role::findByName('instructor')->users();
            $registrations = \DB::table('course_user')
                ->join('users', 'users.id', '=', 'course_user.user_id')
                ->join('courses', 'courses.id', '=', 'course_user.course_id')
                ->select('course_user.*', 'users.name as user_name', 'courses.title as course_title')
                ->orderBy('course_user.registered_at', 'desc')
                ->take(5)
                ->get();
            return view('admin.dashboard', compact(
                'courses',
                'clients',
                'instructors',
                'registrations'
            ));

        } else if (auth()->user()->hasRole('instructor')) {

            $courses = auth()->user()->instructedCourses()->paginate(5);
            return view('instructor.dashboard', compact('courses'));

        } else if (auth()->user()->hasRole('client')) {

            $courses = auth()->user()->enrolledCourses;
            return view('client.dashboard', compact('courses'));

        }
    }
}
