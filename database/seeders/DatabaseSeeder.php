<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\User;
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
        (new User())->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$pK71iUUCzsfRUs5NSaHwiu4y1lhvy2mCu3uXrT0IBd3GAKb4ZnTFm'
        ]);
    }
}
