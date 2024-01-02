<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Sortie extends Model
{
    public $id;
    public $sortie;
    public $types_sortie;
    
    public function __construct($id="",$sortie="",$types_sortie=""){
        $this->id = $id;
        $this->sortie = $sortie;
        $this->types_sortie = $types_sortie;
    }

    public function insertDetails_Sortie(){
        $sql = "insert into details_sortie(sortie, types_sortie) values('".$this->sortie."', ".$this->types_sortie.")";
        $reponse = DB::insert($sql);
        return $reponse;
    }
}