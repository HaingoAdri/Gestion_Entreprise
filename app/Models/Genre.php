<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Genre extends Model
{
    public $id;
    public $genre;

    public function __construct($id) {
        $this->id = $id;
        if($id == 1)
            $this->genre = "Masculin";
        else
            $this->genre = "Feminin";
    }

}
