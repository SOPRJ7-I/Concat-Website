<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Evenementen;


class EvenementenFactory extends Factory
{
    protected $model = Evenementen::class;

    public function definition(): array
    {
        return [
            'title' => 'Community Avond: ' . fake()->word(),
            'image' => fake()->imageUrl(),
            'description' => fake()->paragraph(20),
            'start_time' => fake()->dateTime(),
            'end_time' => fake()->dateTime(),
            'location' => fake()->address(),
            'link' => fake()->url(),
            'capacity' => fake()->numberBetween(10, 100)
        ];
    }
}
