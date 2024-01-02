<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Types_Sortie extends Model
{
    public $id;
    public $type;

    public function __construct($id="",$type="")
    {
        $this->id = $id;
        $this->type = $type;
    }
    
}