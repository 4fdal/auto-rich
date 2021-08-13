<?php

namespace Database\Seeders;

use Database\Seeders\breads\VoyagerDeploymentOrchestratorSeeder;
use Database\Seeders\generate\GenerateSeeder;
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
        // \App\Models\User::factory(10)->create();
        $this->call(VoyagerDeploymentOrchestratorSeeder::class);
        $this->call(GenerateSeeder::class);
    }
}
