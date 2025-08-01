<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Course Participants</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background-color: #f2f2f2; text-align: left; }
    </style>
</head>
<body>
    <h2>Participants for "{{ $course->title }}"</h2>
    <p>Total: {{ $course->students->count() }} / {{ $course->capacity }}</p>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registered On</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($course->students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($student->pivot->registered_at)->format('F j, Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
