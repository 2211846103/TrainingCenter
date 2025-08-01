<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "course_id" => 1,
            "name" => fake()->sentence(3),
            "description" => fake()->sentence(50),
            "type" => "video",
            "file_path" => "misc/placeholder.mp4",
            "extension" => "mp4",
            "length_in_sec" => 94,
            "order" => 1
        ];
    }

    public function forCourse(string $id)
    {
        return $this->state(fn (array $attributes) => [
            'course_id' => $id
        ]);
    }
}
