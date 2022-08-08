<?php

namespace App\Exports\ModeloLote;

use App\Exports\ModeloLote\Sheet\DominiosSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ModeloLote implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new DominiosSheet();
        return $sheets;
    }
}
