<?php

namespace Database\Seeders;


use App\Models\Team;

use App\Models\Event;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
        ]);

        User::factory(10)->create();
        Team::factory(20)->create();
        Event::factory(10)->create();
        Message::factory(20)->create();
    }
}
