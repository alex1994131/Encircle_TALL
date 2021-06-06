<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(TrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OutboundSeeder::class);
        $this->call(TestTypeSeeder::class);
        $this->call(KeydateSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(CampaignSeeder::class);
        $this->call(LibrarySeeder::class);
        $this->call(PatientMessageSeeder::class);
        $this->call(PatientCampaignSeeder::class);
    }
}
