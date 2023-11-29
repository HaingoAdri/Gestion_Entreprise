<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

// use PDF;

class Pdf_controller extends Controller
{

    // INDEX
    public function index() {
        // $pdf = PDF::loadView('pdf_test');
        // return PDF::loadView('pdf_test')
        //     ->setPaper('a4', 'landscape')
        //     ->setWarnings(false)
        //     // ->save(public_path("/home/layah/Documents/testPDF/fichier.pdf"))
        //     ->stream();

        // $pdf = PDF::loadView('pdf_test');
        // return $pdf->download('document.pdf');

        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Hello World</h1>');

        $pdf = PDF::loadView('pdf_test');
        $pdf->save(public_path("/home/layah/Documents/testPDF/fichier.pdf"));
        // return $pdf->stream();
        return $pdf->download("layah.pdf");
    }
}
