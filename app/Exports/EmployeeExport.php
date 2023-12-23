<?php

namespace App\Exports;

use App\Models\employee;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
    protected $checkboxValues;

    public function __construct($checkboxValues)
    {
        $this->checkboxValues = $checkboxValues;
    }

    public function collection(): Collection
    {
        return employee::whereIn('id', $this->checkboxValues)
            ->select('id', 'full_name', 'phone_number', 'email')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Phone',
            'Email',
        ];
    }
}
