<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class MaterialController extends Controller
{
    public function index(Course $course)
    {
        $materials = $course->materials->map(fn ($m) => [
            'id' => $m->id,
            'name' => $m->name,
            'type' => $m->type,
            'description' => $m->description,
            'file_path' => $m->file_path,
            'extension' => $m->extension,
            'length_in_sec' => $m->length_in_sec,
        ])->values();

        return view('instructor.materials.index', compact('course', 'materials'));
    }

    public function relist(Request $request, Course $course)
    {
        $course->materials()->delete();

        foreach ($request->materials as $index => $data) {
            $course->materials()->create([
                'name' => $data['name'],
                'type' => $data['type'],
                'extension' => $data['extension'],
                'description' => $data['description'],
                'file_path' => $data['file_path'],
                'length_in_sec' => $data['length_in_sec'],
                'order' => $index + 1,
            ]);
        }

        return response()->json(['message' => 'Materials updated']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'type' => 'required|string|in:video,document,image',
            'length_in_sec' => 'nullable|integer',
            'file' => 'required|file',
        ]);

        $path = $request->file('file')->store('materials', 'public');

        $material = $course->materials()->create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? '',
            'type' => $validated['type'],
            'file_path' => $path,
            'extension' => $request->file('file')->getClientOriginalExtension(),
            'length_in_sec' => $validated['length_in_sec'] ?? 0,
            'order' => $course->materials()->max('order') + 1,
        ]);

        $material->file_url = Storage::url($material->file_path);
        return response()->json($material);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course, Material $material)
    {
        return view('client.material_show', [
            "material" => $material,
            "course" => $course
        ]);
    }

    public function archiveView(Course $course, Material $material)
    {
        return view('client.archived_show', [
            "material" => $material,
            "course" => $course
        ]);
    }

    public function downloadAll(Course $course)
    {
        $zip = new ZipArchive;
        $zipFilename = $course->title . ".zip";
        $zipPath = storage_path('app/public/'.$zipFilename);

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach ($course->materials as $material) {
                $filePath = storage_path('app/public/' . $material->file_path);
                if (! file_exists($filePath)) continue;
                $zip->addFile($filePath, basename($filePath));
            }
            $zip->close();
        } else {
            abort(500, 'Failed to create ZIP file.');
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
