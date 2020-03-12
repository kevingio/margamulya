<?php

use Illuminate\Database\Seeder;
use App\Models\ContributorType;

class ContributorTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Teologi', 'Germasa', 'Pelkes', 'PPSDI-PPK', 'PEG', 'Inforkom Litbang', 'PA', 'PT', 'GP', 'PKP', 'PKB', 'PKLU'];
        foreach ($types as $type) {
            ContributorType::create(['name' => $type]);
        }
    }
}
