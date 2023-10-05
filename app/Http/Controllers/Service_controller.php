<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Module;
use Illuminate\Support\Facades\DB; // Importez la classe DB

class Service_controller extends Controller
{
    public function index() {
        $service = new Service();
        $listeServices = $service->getListeServices();

        return view('ajout_service', compact("listeServices"));
        return view("ajout_service");
    }

    public function insertService(Request $request) {
        $service_name = $request->input('service_name');

        $service = new Service();
        $service->insertService($service_name);

        return redirect()->route('ajout_service');
    }
}
