<!DOCTYPE html>
<html>
<head>
    <style>
        body { text-align: center; font-family: sans-serif; }
        .cert { border: 10px solid #ccc; padding: 50px; }
        h1 { font-size: 3rem; }
    </style>
</head>
<body>
    <div class="cert">
        <h1>Certificate of Completion</h1>
        <p>This certifies that</p>
        <h2>{{ $user->name }}</h2>
        <p>has completed the course</p>
        <h3>{{ $course->title }}</h3>
        <p>on {{ \Illuminate\Support\Carbon::parse($course->end_date)->format('F j, Y') }}</p>
    </div>
</body>
</html>
