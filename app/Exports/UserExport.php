<?php

namespace App\Exports;

use App\Models\Pet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PetsExport implements FromView, WithColumnWidths, WithStyles
{
    public function view(): View
    {
        return view('pets.excel', [
            'pets' => Pet::all()
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // Id
            'B' => 25,  // Name
            'C' => 20,  // Kind
            'D' => 20,  // Breed
            'E' => 10,  // Age
            'F' => 10,  // Weight
            'G' => 10,  // Active
            'H' => 10,  // Status
            'I' => 20,  // Location
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 16]],
        ];
    }
}
