<?php

namespace Database\Seeders;

use App\Models\Keydate;
use Illuminate\Database\Seeder;

class KeydateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Keydate::factory()
            ->count(5)
            ->create();
    }
}
