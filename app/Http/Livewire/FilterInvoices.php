<?php

namespace App\Http\Livewire;

use App\Exports\InvoiceExport;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class FilterInvoices extends Component
{
  use WithPagination;

  public $filters = [
    'serie' => '',
    'fromNumber' => '',
    'toNumber' => '',
    'fromDate' => '',
    'toDate' => '',
  ];

  public function generateReport() {
    return (new InvoiceExport($this->filters));
  }

  // public function downloadPDF() {
  //   $data = Invoice::all();
  //     // share data to view
  //   $pdf = PDF::loadView('invoices.export', ['data' => $data ]);
  //   var_dump($pdf)
  //     // download PDF file with download method
  //   return $pdf->download('pdf_file.pdf');
  // }

  public function render()
  {

    $invoices = Invoice::filter($this->filters)->paginate();

    return view('livewire.filter-invoices', compact('invoices'));

  }
}
