<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'role'=>'1',
            'name'=>'koung',
            'lastname'=>'koung',
            'phone'=>'55555555',
            'village'=>'1',
            'district'=>'1',
            'province'=>'1',
            'email'=>'koung@gmail.com',
            'password'=>bcrypt(12345678)
        ]);
    }
}
