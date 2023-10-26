<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Qcm_Admis extends Model {
    public $idqcm;
    public $titre;
    public $description;
    public $durer;
    public $id_annonce;
    public $note_total;

    public function insert($titre, $description, $durer, $id_annonce, $note_total) {
        try {
            $requete = "insert into qcm_admis(id_qcm, titre, description, durer, id_annonce, note_total) values (default, '".$titre."', '".$description."', ".$durer.", ".$id_annonce.", ".$note_total.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'insérer qcm admis: " . $e->getMessage());
        }
    }

    public function allQcm() {
        $requete = "select * from qcm_admis ";
        $reponse = DB::select($requete);
        $liste = array();
        if (count($reponse) > 0) {
            foreach ($reponse as $resultat) {
                $Qcm_Admis = new Qcm_Admis();
                $Qcm_Admis->idqcm = $resultat->id_qcm;
                $Qcm_Admis->titre = $resultat->titre;
                $Qcm_Admis->description = $resultat->description;
                $Qcm_Admis->durer = $resultat->durer;
                $Qcm_Admis->id_annonce = $resultat->id_annonce;
                $Qcm_Admis->note_total = $resultat->note_total;
                $liste[] = $Qcm_Admis;
            }
        }
        return $liste;
    }
}
