<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Pv_Utilisation extends Model
{
    public $id;
    public $dates;
    public $reception;
    public $module;

    public function __construct($id="",$dates="",$reception="",$module=""){
        $this->id = $id;
        $this->dates = $dates;
        $this->reception = $reception;
        $this->module = $module;
    }

    public function insert_Pv_utilisation() {
        try {
            $requete = "insert into pv_utilisation(date, reception, module) values ('".$this->dates."', '".$this->reception."', ".$this->module.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert pv_utilisation: " . $e->getMessage());
        }    
    }

    public function get_Pv_utilisation() {
        $requette = "select * from pv_utilisation";
        $reponse = DB::select($requette);
        return $reponse;
    }
}
