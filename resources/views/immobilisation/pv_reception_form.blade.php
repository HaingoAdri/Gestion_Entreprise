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
                            <h2 class="mb-5">Création du proces verbal de récéption</h2>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('insert_pv_reception') }}">
                                
                                <div class="row flex flex-column">
                                    <p><span><u>Bon de commande </u> n° <strong> {{ $numero }}</strong> </span></p>
                                    <p><span><u>Categorie :</u><strong> {{ $compte->id }} </strong> </span></p>
                                    <p><span><u>Sous-categorie :</u><strong> {{ $listeDescription->id }} | {{ $listeDescription->categorie }} </strong> </span></p>
                                </div>

                                <br>

                                <input type="hidden" name="numero_bon" value="{{$numero}}">
                                <input type="hidden" name="id_compte" value="{{$compte->id}}">
                                <input type="hidden" name="categorie" value="{{$listeDescription->id}}">

                                <div class="row mb-2">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="firstName">Date</label>
                                            <input type="date" class="form-control" id="date" name="date">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">

                                        <div class="form-group">
                                            <label for="lastName">Lieu</label>
                                            <select name="lieu" class="form-control">
                                            @if(count($listeLieu) > 0)
                                                @for($i=0; $i<count($listeLieu); $i++)
                                                    <option value="{{$listeLieu[$i]->id}}">{{$listeLieu[$i]->nom}}</option>
                                                @endfor
                                            @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="firstName">Quantite</label>
                                            <input type="text" class="form-control" id="quantite" name="quantite">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="firstName">Etat</label>
                                            <select name="etat" class="form-control">
                                            @if(count($listeEtats) > 0)
                                                @for($i=0; $i<count($listeEtats); $i++)
                                                    <option value="{{$listeEtats[$i]->id}}">{{$listeEtats[$i]->nom}}</option>
                                                @endfor
                                            @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">

                                        <div class="form-group">
                                            <label for="lastName">Type d'ammortissement</label>
                                            <select name="ammortissement" class="form-control" onchange="ajoutTaux()">
                                                <option value="">Ammortissement</option>
                                                @if(count($listeAmmortissements) > 0)
                                                    @for($i=0; $i<count($listeAmmortissements); $i++)
                                                        <option value="{{$listeAmmortissements[$i]->id}}">{{$listeAmmortissements[$i]->nom}}</option>
                                                    @endfor
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="taux" style="display: none;">
                                        <label for="firstName">Taux</label>
                                        <input type="text" class="form-control" id="taux" name="taux" placeholder="Placer un taux entre 0 a 25" value="0">
                                    </div>

                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Recepteur</label>
                                            <input type="text" class="form-control" id="recepteur" name="recepteur" value="{{ Session::get('administrateur_rh')->prenom }} {{ Session::get('administrateur_rh')->nom }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Livreur</label>
                                            <select name="livreur" class="form-control">
                                            @if(count($listeLivreur) > 0)
                                                @for($i=0; $i<count($listeLivreur); $i++)
                                                    <option value="{{$listeLivreur[$i]->id}}">{{$listeLivreur[$i]->nom}}</option>
                                                @endfor
                                            @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-default card-profile">

                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h4 class="mb-5"><u>Description de l'immobilisation</u></h4>

                                        </div>

                                        <div class="card-body">

                                            <div class="row mb-2">
                                                @if(count($listeDescription->listeDescription) > 0)
                                                    @for($i=0; $i<count($listeDescription->listeDescription); $i++)
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="firstName">{{ $listeDescription->listeDescription[$i]->description}}</label>
                                                            <input type="text" class="form-control" id="taille" name="{{$listeDescription->listeDescription[$i]->description}}_{{$listeDescription->listeDescription[$i]->id}}">
                                                        </div>
                                                    </div>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                </div>
           

                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Creation</button>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

</div>


@endsection