<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB

use Carbon\Carbon;


class Pv_radiation extends Model {
    public $id;
    public $date;
    public $immobilisation;
    public $description;
    public $cause;

    public function __construct($id=" ",$date=" ",$immobilisation=" ",$cause=" "){
        $this->id = $id;
        $this->date = $date;
        $this->immobilisation = $immobilisation;
        $this->cause = $cause;
    }

    public function insert_Pv_Radiation(){
        $sql = "insert into pv_radiation(id, date, immobilisation, cause) values ('$this->id','$this->date','$this->immobilisation','$this->cause')";
        $requette = DB::insert($sql);
        return $requette;
    }

    public function show_pv_radiation(){
        $sql = "select * from pv_radiation ";
        $response = DB::select($sql);
        return $response;
    }

    public function getAllDescription(){
        $sql = "select * from description";
        $response = DB::select($sql);
        return $response;
    }

    public function getNextIDPvRadiation() {
        $requette = "select nextID('seqPvRadiation', 'PRAD', 6);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextid;
        }
        return $id;
    }

    public function update_immobilisation($id){
        $sql = "update immobilisation_reception set libre = 64  where id_immobilisation = '$id'";
        $requette = DB::delete($sql);
        return $requette;
    }
}
