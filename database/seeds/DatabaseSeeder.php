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
        $this->call(UsersTableSeeder::class);
        $this->call(ShoppingListTableSeeder::class);
        $this->call(ShoppingItemTableSeeder::class);
        $this->call(FeedbackTableSeeder::class);
    }
}
