<?php

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
        $this->call([
            // Administration
            RolesAndPermissionsSeeder::class,
            SuperAdminSeeder::class,
            // General data
            CountriesSeeder::class,
            // Navigart
            ArtworkSeeder::class,
        ]);
    }
}
