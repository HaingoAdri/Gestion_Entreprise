<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Client extends Model
{
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $mot_de_passe;
    public $date_naissance;
    public $genre;

    public function insertClient($nom, $prenom, $email, $mot_de_passe, $date_naissance, $idGenre) {
        try {
            $requete = "insert into client (nom, prenom, email, mot_de_passe, date_naissance, idGenre) values ('".$nom."','".$prenom."','".$email."','".$mot_de_passe."','".$date_naissance."', ".$idGenre.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert client: ".$e->getMessage());
        }    
    }

    public function getClient($email, $mot_de_passe) {
        $requette = "select * from client where email = '". $email . "' and mot_de_passe = '" . $mot_de_passe."'";
        $reponse = DB::select($requette);
        $client = null;
        if(count($reponse) > 0){
            $client = new Client();
            $client->id = $reponse[0]->id;
            $client->nom = $reponse[0]->nom;
            $client->prenom = $reponse[0]->prenom;
            $client->email = $reponse[0]->email;
            $client->mot_de_passe = $reponse[0]->mot_de_passe;
            $client->date_naissance = $reponse[0]->date_naissance;
            $client->genre = new Genre($reponse[0]->idgenre);
        }
        return $client;
    }

    public function getListeclients() {
        $requette = "select * from client";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $client = new Client();
                $client->id = $reponse[0]->id;
                $client->nom = $reponse[0]->nom;
                $client->prenom = $reponse[0]->prenom;
                $client->email = $reponse[0]->email;
                $client->date_naissance = $reponse[0]->date_naissance;
                $client->genre = new Genre($reponse[0]->idgenre);
                $liste[] = $client;
            }
        }
        return $liste;
    }
}
