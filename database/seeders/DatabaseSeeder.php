<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'BYAMUNGU Lewis',
            'email' => 'byamungulewis@gmail.com',
            'phone' => '0785436135',
            'status' => 'active',
            'role' => 'admin',
            'password' => bcrypt('byamungu')

        ]);
        \App\Models\Department::create([
            'name' => 'Faculty of Economics, Social Sciences and Management',
            'description' => 'Faculty of Economics, Social Sciences and Management',
        ]);
        \App\Models\Department::create([
            'name' => 'Faculty of Education',
            'description' => 'Faculty of Education',
        ]);
        \App\Models\Department::create([
            'name' => 'Faculty of Law and Public Administration',
            'description' => 'Faculty of Law and Public Administration',
        ]);
        \App\Models\Department::create([
            'name' => 'Faculty of Engineering and Technology',
            'description' => 'Faculty of Engineering and Technology',
        ]);
        \App\Models\Department::create([
            'name' => 'Faculty of Sciences and Information Technology',
            'description' => 'Faculty of Sciences and Information Technology',
        ]);
        \App\Models\Department::create([
            'name' => 'Faculty of Health Sciences',
            'description' => 'Faculty of Health Sciences',
        ]);
        // \App\Models\User::factory(5)->create();
    }
}
