<?php

namespace App\Imports;

use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class InvoiceImport implements ToCollection
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  // public function model(array $row)
  // {
  //   return new create([
      // 'serie' => $row[0],
      // 'base' => $row[1],
      // 'tax' => $row[2],
      // 'total' => $row[3],
      // 'user_id' => 1,
  //     'created_at' => Carbon::createFromDate('d/m/Y',$row[4]),
  //   ]);
  // }

  public function collection($rows)
  {
    foreach ($rows as $row) {
      $invoice = Invoice::create([
        'serie' => $row[0],
        'base' => $row[1],
        'tax' => $row[2],
        'total' => $row[3],
        'user_id' => Auth()->user()->id,
      ]);
    }
  }
}
