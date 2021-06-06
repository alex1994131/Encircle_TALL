<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PatientCampaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientCampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PatientCampaign::class;

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
            'patient_id' => \App\Models\Patient::factory(),
            'campaign_id' => \App\Models\Campaign::factory(),
        ];
    }
}
