<?php

namespace App\Exports;

use App\Models\Adoption;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AdoptionsExport implements FromCollection, WithHeadings, WithStyles, WithEvents, ShouldAutoSize
{
    public function collection()
    {
        $adopts = Adoption::with(['user','pet'])->get();

        $rows = collect();
        foreach ($adopts as $adopt) {
            $rows->push([
                'document' => optional($adopt->user)->document,
                'fullname' => optional($adopt->user)->fullname,
                'phone' => optional($adopt->user)->phone,
                'user_photo' => optional($adopt->user)->photo ?? '',
                'pet_name' => optional($adopt->pet)->name,
                'pet_kind' => optional($adopt->pet)->kind,
                'pet_breed' => optional($adopt->pet)->breed,
                'pet_location' => optional($adopt->pet)->location,
                'pet_image' => optional($adopt->pet)->image ?? '',
            ]);
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'User Document',
            'User Fullname',
            'User Phone',
            'User Photo',
            'Pet Name',
            'Pet Kind',
            'Pet Breed',
            'Pet Location',
            'Pet Image',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Set header row styling
                $sheet->getStyle('A1:I1')->getFont()->setBold(true);

                // Column widths
                $sheet->getColumnDimension('A')->setWidth(15);
                $sheet->getColumnDimension('B')->setWidth(25);
                $sheet->getColumnDimension('C')->setWidth(15);
                $sheet->getColumnDimension('D')->setWidth(12);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(12);
                $sheet->getColumnDimension('G')->setWidth(15);
                $sheet->getColumnDimension('H')->setWidth(18);
                $sheet->getColumnDimension('I')->setWidth(12);

                $startRow = 2;
                $rows = $event->sheet->getHighestRow();

                for ($row = $startRow; $row <= $rows; $row++) {
                    // Increase row height for images
                    $sheet->getRowDimension($row)->setRowHeight(60);

                    // User photo (column D)
                    $uph = $sheet->getCell('D'.$row)->getValue();
                    if ($uph && $uph !== '') {
                        $path = public_path('images/'.$uph);
                        if (file_exists($path) && in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg','jpeg','png','gif','bmp'])) {
                            $drawing = new Drawing();
                            $drawing->setPath($path);
                            $drawing->setHeight(50);
                            $drawing->setCoordinates('D'.$row);
                            $drawing->setOffsetX(5);
                            $drawing->setWorksheet($sheet);
                        }
                    }

                    // Pet image (column I)
                    $pph = $sheet->getCell('I'.$row)->getValue();
                    if ($pph && $pph !== '') {
                        $path2 = public_path('images/'.$pph);
                        if (file_exists($path2) && in_array(strtolower(pathinfo($path2, PATHINFO_EXTENSION)), ['jpg','jpeg','png','gif','bmp'])) {
                            $drawing2 = new Drawing();
                            $drawing2->setPath($path2);
                            $drawing2->setHeight(50);
                            $drawing2->setCoordinates('I'.$row);
                            $drawing2->setOffsetX(5);
                            $drawing2->setWorksheet($sheet);
                        }
                    }
                }
            },
        ];
    }
}
