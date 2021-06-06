<?php

namespace Database\Factories;

use App\Models\Outbound;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OutboundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Outbound::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => $this->faker->text,
            'message_data' => $this->faker->text(255),
            'recipient' => $this->faker->text(255),
            'trust' => $this->faker->text(255),
            'trust_logo' => $this->faker->text(255),
            'keydate_id' => \App\Models\Keydate::factory(),
        ];
    }
}
