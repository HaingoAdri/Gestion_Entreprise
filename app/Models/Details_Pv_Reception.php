<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB

use Carbon\Carbon;


class Details_Pv_Reception extends Model {

    public $id_pv_reception;
    public $id_description;
    public $information;

    public function __construct($id_pv_reception = "", $id_description = 0, $information = "") {
        $this->id_pv_reception = $id_pv_reception;
        $this->id_description = $id_description;
        $this->information = $information;
    }

    public function insert() {
        try {
            $requete = "insert into details_pv_reception(id_pv_reception, id_description, information) values ('". $this->id_pv_reception."', ". $this->id_description .", '". $this->information."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un details pv de reception: ".$e->getMessage());
        }    
    }

}
