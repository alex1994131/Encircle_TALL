<?php

namespace Database\Factories;

use App\Models\Keydate;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class KeydateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Keydate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'test_order' => $this->faker->text(255),
            'next_test_order' => $this->faker->text(255),
            'lab_ref' => $this->faker->text(255),
            // 'next_appointment' => $this->faker->text(255),
            'apt_date' => $this->faker->dateTime,
            // 'campaign_num' => $this->faker->randomNumber(0),
            'results' => $this->faker->text(255),
            'patient_id' => \App\Models\Patient::factory(),
            'test_types' => \App\Models\TestType::factory(),
        ];
    }
}
