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
            'titel' => $this->faker->sentence,
            'datum' => now()->toDateString(),
            'starttijd' => '18:00',
            'einddatum' => now()->toDateString(),
            'eindtijd' => '20:00',
            'locatie' => $this->faker->city,
            'link' => fake()->url(),
            'capacity' => fake()->numberBetween(10, 100)
        ];
    }
}
