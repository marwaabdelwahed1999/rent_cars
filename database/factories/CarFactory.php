<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;


class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'published' => 0,
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->numberBetween(10000, 50000),
            'Luggage' => $this->faker->numberBetween(1, 5),
            'Doors' => $this->faker->numberBetween(2, 4),
            'Passenger' => $this->faker->numberBetween(1, 5),
            'category_id' => fake()->numberBetween(1,10),
            'created_at' => $this->faker->dateTimeThisMonth(),
            'updated_at' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
