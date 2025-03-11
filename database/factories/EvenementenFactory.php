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
            'naam' => $this->faker->sentence(3),
            'beschrijving' => $this->faker->paragraph(),
            'locatie' => $this->faker->city(),
            'start_datum' => $this->faker->date(),
            'eind_date' => $this->faker->date(),
            'ticket_link' => $this->faker->url(),
        ];
    }
}
