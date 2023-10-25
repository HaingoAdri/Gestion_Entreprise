<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;
use App\Models\Besoin;
use App\Models\Details_Besoin_Age;
use App\Models\Details_Besoin_Diplome;
use App\Models\Details_Besoin_Experience;
use App\Models\Genre;

class Annonce extends Model
{
    public $Age;
    public $Experience;
    public $Genre;
    public $Diplome;
    public $Nationalite;
    public $Region;
    public $Matrimoniale;

    public function getAge($idBesoin){
        $dataAge = (new Details_Besoin_Age())->getListeBesoinsAgeParIdBesoin($idBesoin);
        $minimumAge = $dataAge[0]->min;
        $maximumAge = $dataAge[count($dataAge)-1]->max;
        return [$minimumAge, $maximumAge];
    }

    public function getNationalite($idBesoin){
        $dataNationalite = (new Details_Besoin_Nationalite())->getListeBesoinsNationaliteParIdBesoin($idBesoin);
        $nationalites = array();
        for($i=0; $i<count($dataNationalite); $i++){
            $nationalites[] = $dataNationalite[$i]->nationalite->type;
        }
        return $nationalites;
    }
    
    public function getDiplome($idBesoin){
        $dataDiplome = (new Details_Besoin_Diplome())->getListeBesoinsDiplomeParIdBesoin($idBesoin);
        $diplomes = array();
        for($i=0; $i<count($dataDiplome); $i++){
            $diplomes[] = $dataDiplome[$i]->diplome->type;
        }
        return $diplomes;
    }

    public function getMatrimoniale($idBesoin){
        $dataMatrimoniale = (new Details_Besoin_Matrimoniale())->getListeBesoinsMatrimonialeParIdBesoin($idBesoin);
        $matrimoniales = array();
        for($i=0; $i<count($dataMatrimoniale); $i++){
            $matrimoniales[] = $dataMatrimoniale[$i]->matrimoniale->type;
        }
        return $matrimoniales;
    }

    public function getExperience($idBesoin){
        $dataExperience = (new Details_Besoin_Experience())->getListeBesoinsExperienceParIdBesoin($idBesoin);
        $experiences = array();
        for($i=0; $i<count($dataExperience); $i++){
            $experiences[] = $dataExperience[$i]->annee_experience;
        }
        return $experiences;
    }

    public function getRegion($idBesoin){
        $dataRegion = (new Details_Besoin_Region())->getListeBesoinsRegionParIdBesoin($idBesoin);
        $regions = array();
        for($i=0; $i<count($dataRegion); $i++){
            $regions[] = $dataRegion[$i]->region->type;
        }
        return $regions;
    }

    public function createAnnonce($idBesoin){
        $annonce = new Annonce();
        $annonce->Age = $this->getAge($idBesoin);
        $annonce->Nationalite = $this->getNationalite($idBesoin);
        $annonce->Genre = (new Details_Besoin_Genre())->getUneBesoinGenre($idBesoin);
        $annonce->Diplome = $this->getDiplome($idBesoin);
        $annonce->Matrimoniale = $this->getMatrimoniale($idBesoin);
        $annonce->Experience = $this->getExperience($idBesoin);
        $annonce->Region = $this->getRegion($idBesoin);
        return $annonce;
    }
}