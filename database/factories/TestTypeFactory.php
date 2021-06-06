<?php

namespace Database\Factories;

use App\Models\TestType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TestType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'test_name' => $this->faker->name,
        ];
    }
}
