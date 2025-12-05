<?php

namespace App\Exports;

use App\Models\Pet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PetsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pet::select('id','name','kind','breed','age','weight','active','status','location')->get();
    }

    public function headings(): array
    {
        return ['Id','Name','Kind','Breed','Age','Weight','Active','Status','Location'];
    }
}
