<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'John Doe',
            'username'  => 'johndoe',
            'password'  => bcrypt('secret'),
        ]);

        User::create([
            'name'      => 'Marry Jane',
            'username'  => 'maryjane',
            'password'  => bcrypt('secret'),
        ]);
    }
}
