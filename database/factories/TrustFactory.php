<?php

namespace Database\Factories;

use App\Models\Trust;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrustFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trust::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'logo' => $this->faker->text(255),
        ];
    }
}
