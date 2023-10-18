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
            'image'=>'6528fa06a40f0image8.jpg',
            'password'=>Hash::make('admin123')
        ]);
        User::create([
            'name'=>'Admin1',
            'email'=>'Admin1@gmail.com',
            'gender'=>'male',
            'phone'=>'09426979396',
            'address'=>'yangon',
            'image'=>'6528eda8693d5image6.jpg',
            'role'=>'admin',
            'password'=>Hash::make('admin1123')
        ]);
        User::create([
            'name'=>'Admin2',
            'email'=>'Admin2@gmail.com',
            'gender'=>'male',
            'phone'=>'09426979396',
            'address'=>'yangon',
            'image'=>'6528edd3c1c89image9.jpg',
            'role'=>'admin',
            'password'=>Hash::make('admin2123')
        ]);
        User::create([
            'name'=>'Admin3',
            'email'=>'Admin3@gmail.com',
            'gender'=>'female',
            'phone'=>'09426979396',
            'address'=>'yangon',
            'image'=>'65291a7293626image4.jpg',
            'role'=>'admin',
            'password'=>Hash::make('admin3123')
        ]);
        User::create([
            'name'=>'Admin4',
            'email'=>'Admin4@gmail.com',
            'gender'=>'female',
            'phone'=>'09426979396',
            'address'=>'yangon',
            'image'=>'6528f9c719a7bimage2.jpg',
            'role'=>'admin',
            'password'=>Hash::make('admin4123')
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
