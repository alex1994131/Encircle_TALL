<?php

namespace Database\Seeders;

use App\Models\Outbound;
use Illuminate\Database\Seeder;

class OutboundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outbound::factory()
            ->count(5)
            ->create();
    }
}
