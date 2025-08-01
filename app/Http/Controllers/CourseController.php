<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Services\ImageService;
use App\Services\StripeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Course::query()->whereNot('status', 'draft');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        $courses = $query->paginate(3)->withQueryString();

        return view('courses.index', compact('courses'));
    }

    public function manage()
    {
        $courses = Course::paginate(5);

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'instructor')->toArray()
        )->all();
        return view('admin.courses.create', compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category' => ['nullable', 'string', 'max:255'],
            'instructor_id' => ['required', 'exists:users,id'],
            'skill_level' => ['required', 'in:beginner,intermediate,professional'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'mode' => ['required', 'in:offline,online'],
            'location' => ['nullable', 'string', 'max:255'],
            'certified' => ['nullable', 'boolean'],
        ]);

        
        $course = Course::create($data);
        
        $stripe = new StripeService()->createCourseProduct(
            $course->title,
            $course->description,
            $course->price * 100,
        );
        
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = ImageService::storeCourseThumbnail($course->id, $file);
            $course->thumbnail = $filename;
        } else $course->thumbnail = ImageService::generate();

        $course->stripe_price_id = $stripe['price_id'];
        $data['certified'] = $request->has('certified');
        $course->save();

        return redirect()->route('dashboard');
    }

    public function generateCertificate(string $id)
    {
        $user = auth()->user();

        $course = Course::find($id);

        $pdf = Pdf::loadView('export.certificate', compact('user', 'course'));

        return $pdf->download("{$course->title} Certificate.pdf");
    }

    public function publish(Course $course)
    {
        if ($course->materials()->count() < 1) {
            return back()->with('error', 'Course must have at least one material to be published.');
        }

        $course->update([
            'status' => 'published'
        ]);

        return redirect()->route('courses.manage');
    }

    public function archive(Course $course)
    {
        $course->update([
            'status' => 'archived'
        ]);

        return redirect()->route('courses.manage');
    }

    public function students(Course $course)
    {
        return view('instructor.students', compact('course'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $instructors = Role::findByName('instructor')->users()->get();
        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category' => ['nullable', 'string', 'max:255'],
            'instructor_id' => ['required', 'exists:users,id'],
            'skill_level' => ['required', 'in:beginner,intermediate,professional'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'mode' => ['required', 'in:offline,online'],
            'location' => ['nullable', 'string', 'max:255'],
            'certified' => ['nullable', 'boolean'],
        ]);

        $course->update($data);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = ImageService::storeCourseThumbnail($course->id, $file);
            $course->thumbnail = $filename;
        }

        $course->certified = $request->has('certified');
        $course->save();

        return redirect()->route('courses.manage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.manage');
    }
}
