<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VendorItem>
 */
class VendorItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new FakerFoodProvider($this->faker));
        return [
            'vendor_id' => null, // Assigned in the seeder
            'name' => $this->faker->foodName, // Requires faker extension
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 5, 50), // Price between $5 and $50
        ];
    }
}

