<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class Pdf_controller extends Controller
{

    // INDEX
    public function index() {

        $pdf = PDF::loadView('pdf_test');
        $pdf->save(storage_path('app/public/demande_de_proforma1.pdf'));
        return $pdf->stream("demande_de_proforma1.pdf");

    }

}
