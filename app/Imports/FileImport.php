<?php

namespace App\Imports;

use App\Models\FileUpload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //Heading Row class to detect headers in a csv file

class FileImport implements ToModel, WithHeadingRow // include the WithHeadingRow when using it
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row) //function to insert csv contents to database
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
