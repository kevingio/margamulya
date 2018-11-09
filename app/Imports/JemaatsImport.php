<?php

namespace App\Imports;

use App\Models\Jemaat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;

class JemaatsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if($index > 0) {
                Jemaat::create([
                    'name' => $row[0],
                    'dob' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
                    'gender' => $row[2],
                    'address' => $row[3],
                    'sector' => $row[4]
                ]);
            }
        }
    }
}
