<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnFormatting,
    WithColumnWidths
{
    /**
     * Exported data
     */
    public function collection()
    {
        return User::select('id', 'name', 'email', 'created_at')->get();
    }

    /**
     * Header row text
     */
    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Created At'];
    }

    /**
     * Make the header row bold & centered
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // first row
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    /**
     * Format specific columns (e.g., date format)
     */
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Created At column
        ];
    }

    /**
     * Optional fixed widths for nicer layout
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
            'C' => 30,
            'D' => 20,
        ];
    }
}
