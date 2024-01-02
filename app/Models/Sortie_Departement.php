<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Sortie_Departement extends Model
{
    public $id;
    public $sortie_details;
    public $module;
    
    public function __construct($id="",$sortie_details="",$module=""){
        $this->id = $id;
        $this->sortie_details = $sortie_details;
        $this->module = $module;
    }  
    
    public function insertSotrieDepartement(){
        $sql = "insert into sortie_departement(sortie_details,module) values ('".$this->sortie_details."', ".$this->module.")";
        $reponse = DB::insert($sql);
        return $reponse;
    }

    public function getSortieDepartement(){
        $sql = "select * from sortie_departement";
        $reponse = DB::select($sql);
        return $reponse;
    }

    public function getSortie_Departement(){
        $sql = "select * from V_departement";
        $reponse = DB::select($sql);
        return $reponse;
    }
}