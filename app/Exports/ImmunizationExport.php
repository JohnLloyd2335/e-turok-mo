<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ImmunizationExport implements FromView
{
    
    public function __construct($immunizations)
    {
        $this->immunizations = $immunizations;
    }
    public function view(): View
    {
        return view('immunizationExport',[
            'immunizations' => $this->immunizations
        ]);
    }
}
