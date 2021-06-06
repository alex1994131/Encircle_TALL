<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PatientMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PatientMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text,
            'data' => $this->faker->text(255),
            'patient_id' => \App\Models\Patient::factory(),
            'patient_campaign_id' => \App\Models\PatientCampaign::factory(),
            'library_id' => \App\Models\Library::factory(),
        ];
    }
}
