<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Salaire extends Model {
    public $id;
    public $id_emp;
    public $brut;
    public $net;
    public $date;

    public function __construct($id = "", $id_emp = "", $brut = "", $net = "", $date = "") {
        $this->id = $id;
        $this->id_emp = $id_emp;
        $this->brut = $brut;
        $this->net = $net;
        $this->date = $date;
    }

    public function insert() {
        try {
            $requete = "insert into salaire (id_emp, brut, net, date) values (".$this->id_emp.",".$this->brut.",".$this->net.", '".$this->date."')";
            Console.WriteLine($requete);
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Employer: ".$e->getMessage());
        }    
    }

    public function getSalaireEmploye() {
        $requette = "select * from salaire where id_emp = '". $this->id_emp ."' and date <= '". $this->date ."' order by date desc;";
        $reponse = DB::select($requette);
        $Employer = null;
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Employer = new Employer();
                $Employer->id  = $resultat->id;
                $Employer->id_emp  = $resultat->id_emp;
                $Employer->brut  = $resultat->brut;
                $Employer->net  = $resultat->net;
                $Employer->date  = $resultat->date;
                break;
            }
        }
        return $Employer;
    }
}
