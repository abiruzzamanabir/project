<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
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

        Admin::create([
            'fast_name' => 'Provider',
            'last_name' => '',
            'email' => 'Provider@gmail.com',
            'cell' => '01763872277',
            'username' => 'provider',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
        ]);
        Admin::create([
            'fast_name' => 'Abiruzzaman',
            'last_name' => '',
            'email' => 'Abiruzzamanabir17@gmail.com',
            'cell' => '01763872217',
            'username' => 'Abir',
            'password' => Hash::make('123'),
            'role_id' => 3,
        ]);


        Permission::create([
            'name' => 'Slider',
            'slug' => 'slider',
        ]);
        Permission::create([
            'name' => 'Testimonial',
            'slug' => 'testimonial',
        ]);
        Permission::create([
            'name' => 'Our client',
            'slug' => 'our-client',
        ]);
        Permission::create([
            'name' => 'Our team',
            'slug' => 'our-team',
        ]);
        Permission::create([
            'name' => 'Portfolio',
            'slug' => 'portfolio',
        ]);
        Permission::create([
            'name' => 'Post',
            'slug' => 'post',
        ]);
        Permission::create([
            'name' => 'Admin user',
            'slug' => 'admin-user',
        ]);
        Permission::create([
            'name' => 'Setting',
            'slug' => 'setting',
        ]);


        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permission' => '["Admin user","Our client","Our team","Portfolio","Post","Setting","Slider","Testimonial"]',
        ]);
        Role::create([
            'name' => 'User',
            'slug' => 'user',
            'permission' => '["Post","Setting"]',
        ]);
        Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'permission' => '["Our client","Our team","Portfolio","Post","Setting","Slider","Testimonial"]',
        ]);
    }
}
