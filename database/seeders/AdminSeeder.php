<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new Admin();
        $obj->name = 'Admin';
        $obj->email = 'admin@gmail.com';
        $obj->password = Hash::make('12345678');
        $obj->save();
    }
}
