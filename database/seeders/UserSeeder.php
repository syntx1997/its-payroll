<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Sherwin Bautista',
            'email' => 'sherwin@admin.com',
            'password' => bcrypt('sherwin@1234'),
            'type' => 'HR'
        ]);
    }
}
