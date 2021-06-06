<?php

namespace Database\Seeders;

use App\Models\Trust;
use Illuminate\Database\Seeder;

class TrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trust::factory()
            ->count(5)
            ->create();
    }
}
