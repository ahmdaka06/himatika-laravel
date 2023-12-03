<?php

namespace App\Imports;

use App\Models\VideoGame;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportVideoGame implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if ($row[0] == 'name') continue;
            VideoGame::create([
                'name' => $row[0] ?? '-',
                'platform' => $row[1] ?? '-',
                'release_date' => isset($row[2]) ? Date::excelToDateTimeObject($row[2]) : null,
                'summary' => $row[3] ?? '-',
                'reviews' => $row[4] ?? '0',
            ]);
        }
    }
}
