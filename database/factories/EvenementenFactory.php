<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Evenementen;

class EvenementenFactory extends Factory
{
    protected $model = Evenementen::class;

    public function definition()
    {
        return [
            'titel' => fake()->word(),
            'datum' => fake()->date(),
            'starttijd' => fake()->time(),
            'eindtijd' => fake()->time(),
            'beschrijving' => fake()->paragraph(250),
            'locatie' => fake()->address(),
            'aantal_beschikbare_plekken' => fake()->numberBetween(10, 100),
            'betaal_link' => fake()->url(),
            'categorie' => fake()->word(),
        ];
    }
}
