@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content"><!-- Card Profile -->
        <div class="row">
            <div class="col-md-2"></div>
        
            <div class="col-md-8">
                <div class="card card-default card-profile">

                    <div class="card card-default">
                        <div class="card-header">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="font-weight-bold">Liste des besoins</h3>

                                    <br>

                                    <span style="display: block;"><strong>Entreprise : MONO</strong></span>
                                    <span style="display: block;"><strong>Téléphone : 0324525225</strong></span>
                                    <span style="display: block;"><strong>Email : mono_th@yahoo.fr</strong></span>

                                </div>
                            </div>

                        </div>

                        <div class="card-body">

                            <form action="#">

                                <div class="row">
                                    <div class="col-md-6">
                                        <span style="display: block;"><strong>Lieu : </strong> {{ $lieu }} </span>
                                        <span style="display: block;"><strong>N° de commande : </strong> {{ $donnees->id }} </span>
                                        <span style="display: block;"><strong>Titre de la commande : </strong> {{ $donnees->nom }} </span>
                                        <span style="display: block;"><strong>Date de la commande : </strong> {{ $donnees->date }} </span>
                                        <span style="display: block;"><strong>Responsable de récéption : </strong> {{ Session::get('administrateur_rh')->prenom }} {{ Session::get('administrateur_rh')->nom }} </span>
                                    </div>
                                    
                                </div>

                                <br><br>

                                    <div class="row">
                                        <div class="col-md-12">

                                                <h5 class="text-secondary text-capitalize"><u>Détails : </u></h5>

                                                <br>
                                                
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Désignation</th>
                                                            <th scope="col">Quantités</th>
                                                            <th scope="col">Fournisseur</th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for($i=0; $i<count($liste_details_bon_commande) - 1; $i++)
                                                            <tr>
                                                                <td scope="row"> {{ $liste_details_bon_commande[$i]->idArticle }} </td>
                                                                <td> {{ $liste_details_bon_commande[$i]->getArticle() }} </td>
                                                                <td> {{ $liste_details_bon_commande[$i]->quantite }} </td>
                                                                <td> {{ $liste_details_bon_commande[$i]->getNomFournisseur() }} </td>
                                                                <td> {{ $liste_details_bon_commande[$i]->description }} </td>
                                                                <td>
                                                                    <a href="{{ route('create_pv_reception', ['idArticle' => $liste_details_bon_commande[$i]->idArticle, 'bonCommande' => $donnees->id, 'categorie' => $liste_details_bon_commande[$i]->sousCategorie ]) }}"><button type="button" class="btn btn-primary">Faire un PV</button></a>    
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table> 
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>Edité le :  {{ $date }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary btn-pill">Valider</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

</div>
@endsection