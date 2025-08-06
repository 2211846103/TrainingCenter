<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\User;
use App\Services\ImageService;
use App\Services\StripeService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(2),
            "thumbnail" => ImageService::generate(),
            "description" => fake()->sentence(15),
            "skill_level" => fake()->randomElement(["beginner", "intermediate", "professional"]),
            "start_date" => fake()->dateTimeBetween("now", "now"),
            "end_date" => fake()->dateTimeBetween("now", "+6 months"),
            "mode" => fake()->randomElement(["online", "offline"]),
            "location" => fake()->address(),
            "instructor_id" => User::factory()->instructor(),
            "price" => fake()->randomFloat(2, 0, 200),
            "category" => fake()->word(),
            "capacity" => fake()->randomNumber(2),
            "status" => fake()->randomElement(["published", "archived"]),
            "certified" => fake()->boolean(20)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($course) {
            for ($i = 1; $i <= 5; $i++) {
                Material::factory()->create([
                    'course_id' => $course->id,
                    'order' => $i,
                    'type' => "video",
                    'extension' => 'mp4',
                    'file_path' => 'misc/placeholder.mp4', // tweak too
                ]);
            }

            $service = new StripeService();
            $stripe  = $service->createCourseProduct(
                $course->title,
                $course->description,
                $course->price * 100,
            );
            $course->stripe_price_id = $stripe['price_id'];
            $course->save();
        });
    }
}
