<?php

use Illuminate\Database\Seeder;
use App\Models\Jemaat;

class JemaatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Jemaat::class, 2000)->create();
    }
}
