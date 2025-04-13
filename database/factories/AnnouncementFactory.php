<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition()
    {
        return [
            'titel' => $this->faker->sentence,
            'inhoud' => $this->faker->paragraph,
            'publicatiedatum' => now(),
            'vervaldatum' => null,
            'isVisible' => true,
        ];
    }
}
