<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();
        DB::table('subscriptions')->truncate();
        DB::table('posts')->truncate();

        Schema::enableForeignKeyConstraints();
        
        $this->call([
            UserSeeder::class,
            SubscriptionSeeder::class,
            PostSeeder::class,
        ]);

    }
}
