<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'skill_level',
        'duration_weeks',
        'start_date',
        'end_date',
        'mode',
        'location',
        'instructor_id',
        'price',
        'category',
        'capacity',
        'status',
        'stripe_price_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
            ->withPivot('registered_at')
            ->withTimestamps();
    }

    public function materials()
    {
        return $this->hasMany(Material::class)->orderBy('order');
    }
}