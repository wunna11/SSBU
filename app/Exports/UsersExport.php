<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $columns = ['name', 'email', 'user_name', 'gender', 'phone', 'dob'];

    public function __construct(public Collection $records)
    {
        //
    }

    public function collection()
    {
        return $this->records;
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->user_name,
            $user->gender,
            $user->phone,
            $user->dob
        ];
    }

    public function headings(): array
    {
        return $this->columns;
    }
}
