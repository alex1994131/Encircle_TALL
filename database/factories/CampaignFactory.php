<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'condition' => $this->faker->text(255),
            'subcondition' => $this->faker->text(255),
            'content' => '',
            'published' => $this->faker->boolean,
            'trust_id' => \App\Models\Trust::factory(),
        ];
    }
}
