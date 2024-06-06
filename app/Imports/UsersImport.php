<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function headingRow(): int
    {
        return 1;
    }

    public function model(array $row)
    {
        // dd($row[0]);
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'user_name' => $row['user_name'],
            'gender' => $row['gender'],
            'phone' => $row['phone'],
            'dob' => $row['dob'],
            'password' => '123456',
        ]);
    }
}
