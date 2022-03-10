<?php

namespace App\Imports;

use App\Models\FileUpload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FileImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FileUpload([
            'year' => $row['year'],
            'rank' => $row['rank'],
            'recipient' => $row['recipient'],
            'country' => $row['country'],
            'career' => $row['career'],
            'tied' => $row['tied'],
            'title' => $row['title']
        ]);
    }
}
