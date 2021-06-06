<?php

namespace Database\Factories;

use App\Models\Library;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibraryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Library::class;

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
            'published' => $this->faker->boolean,
            'campaign_id' => \App\Models\Campaign::factory(),
        ];
    }
}
