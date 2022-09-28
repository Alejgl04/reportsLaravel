<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\Support\Responsable;

use Maatwebsite\Excel\Concerns\FromCollection;
Use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;

class InvoiceExport implements FromCollection, 
                               WithCustomStartCell,
                               Responsable, 
                               WithMapping, 
                               WithColumnFormatting, 
                               WithHeadings, 
                               WithColumnWidths,
                               WithDrawings,
                               WithStyles
{
  use Exportable;
  private $filters;
  private $fileName  = 'invoices.xlsx';
  private $fileType  = Excel::XLSX;

  public function __construct($filters)
  {
    $this->filters = $filters;
  }

  public function collection()
  {
    return Invoice::filter($this->filters)->get();
  }

  public function startCell(): string
  {
    return 'A11';
  }

  public function headings(): array {
    return [
      'Serie',
      'Correlativo',
      'Base',
      'Tax',
      'Total',
      'Date',
    ];  
  }

  public function map($invoice): array
  {
    return [
      $invoice->serie,
      $invoice->correlative,
      $invoice->base,
      $invoice->tax,
      $invoice->total,
      Date::dateTimeToExcel($invoice->created_at),
    ];
  }

  public function columnFormats(): array {
    return [
      'F' => 'dd/mm/yyyy'
    ];
  }

  public function columnWidths(): array
  {
    return [
      'A' => 10,
      'B' => 10,
      'C' => 10,
      'D' => 10,
      'E' => 10,
      'F' => 15,
    ];
  }

  public function drawings() {
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('AG Site');
    $drawing->setPath(public_path('images/logo.jpeg'));
    $drawing->setHeight(130);
    $drawing->setCoordinates('B3');

    return $drawing;
  }

  public function styles(Worksheet $sheet) {
    $sheet->setTitle('Invoices');
    $sheet->mergeCells('A10:F10');
    // $sheet->setCellValue('B9','');
    
    $sheet->getStyle('A11:F'. $sheet->getHighestRow())->applyFromArray([
      'borders' => [
        'allBorders' => [
          'borderStyle' => 'thin'          
        ],
      ],
    ]);
  }
}
