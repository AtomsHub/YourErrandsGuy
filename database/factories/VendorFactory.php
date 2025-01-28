<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->catchPhrase,
            'image' => $this->faker->imageUrl(640, 480, 'food', true),
            // 'latitude' => $this->faker->latitude(-90, 90),
            // 'longitude' => $this->faker->longitude(-180, 180),
        ];
    }
}
