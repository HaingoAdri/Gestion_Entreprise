<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importez la classe DB

class Besoin_controller extends Controller
{
    public function index() {
        return view("ajout_besoin");
    }
}
