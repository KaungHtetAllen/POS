<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        User::create([
            'name'=>'Admin',
            'email'=>'Admin@gmail.com',
            'gender'=>'male',
            'phone'=>'09426979396',
            'address'=>'yangon',
            'role'=>'admin',
            'password'=>Hash::make('admin123')
        ]);

        User::create([
            'name'=>'User',
            'email'=>'User@gmail.com',
            'gender'=>'male',
            'phone'=>'09752437332',
            'address'=>'yangon',
            'role'=>'user',
            'password'=>Hash::make('user123')
        ]);

        Category::create([
            'name'=>'Myanmar Pizza'
        ]);
        Category::create([
            'name'=>'Chinese Pizza'
        ]);
        Category::create([
            'name'=>'Korean Pizza'
        ]);
        Category::create([
            'name'=>'Thai Pizza'
        ]);
        Category::create([
            'name'=>'American Pizza'
        ]);
        Category::create([
            'name'=>'Italian Pizza'
        ]);
        Category::create([
            'name'=>'India Pizza'
        ]);
        Category::create([
            'name'=>'Philippines Pizza'
        ]);
        Category::create([
            'name'=>'Vietnamese Pizza'
        ]);
        Category::create([
            'name'=>'Indonesian Pizza'
        ]);
    }
}
