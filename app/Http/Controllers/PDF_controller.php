<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\BesoinAchat;

// use PDF;

class PDF_controller extends Controller
{

    public function index() {

        $pdf = PDF::loadView('pdf_test');
        return $pdf->download("layah.pdf");

    }

    public function demande(){
        $listeBesoinNonValide = (new BesoinAchat())->getListeBesoinNonValide();
        $pdf = PDF::loadView('pdf_test', compact("listeBesoinNonValide"));
        return $pdf->download("demande_de_proforma.pdf");
    }

}
