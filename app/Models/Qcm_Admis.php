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
    public $id_cv;

    public function __construct($idqcm = "", $titre = "", $description = "", $durer = "", $id_annonce = "", $note_total = "", $id_cv = "") {
        $this->idqcm = $idqcm;
        $this->titre = $titre;
        $this->description = $description;
        $this->durer = $durer;
        $this->id_annonce = $id_annonce;
        $this->note_total = $note_total;
        $this->id_cv = $id_cv;
    }

    public function insert($titre, $description, $durer, $id_annonce, $note_total, $id_cv) {
        try {
            $requete = "insert into qcm_admis(id_qcm, titre, description, durer, id_annonce, note_total, id_cv) values (default, '".$titre."', '".$description."', ".$durer.", ".$id_annonce.", ".$note_total.", ".$id_cv.")";
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
                $Qcm_Admis->id_cv = $resultat->id_cv;
                $liste[] = $Qcm_Admis;
            }
        }
        return $liste;
    }

    public function getUn_Qcm_Admis_par_id() {
        $requete = "select * from qcm_admis where id_qcm = ". $this->idqcm;
        $reponse = DB::select($requete);
        $Qcm_Admis = null;
        if (count($reponse) > 0) {
            foreach ($reponse as $resultat) {
                $Qcm_Admis = new Qcm_Admis();
                $Qcm_Admis->idqcm = $resultat->id_qcm;
                $Qcm_Admis->titre = $resultat->titre;
                $Qcm_Admis->description = $resultat->description;
                $Qcm_Admis->durer = $resultat->durer;
                $Qcm_Admis->id_annonce = $resultat->id_annonce;
                $Qcm_Admis->note_total = $resultat->note_total;
                $Qcm_Admis->id_cv = $resultat->id_cv;
                break;
            }
        }
        return $Qcm_Admis;
    }


}
