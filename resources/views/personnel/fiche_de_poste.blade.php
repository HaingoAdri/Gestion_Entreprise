@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Fiche de Poste</h2>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        @if(!isset($fiche))
                        <form method="POST" action="{{ route('fiche_de_poste') }}">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Recherche d'un Personnel</h5>
                            </div>
                            <div class="modal-body px-4">
                                <div class="form-group">
                                    <label for="lastName">Numero de matricule</label>
                                    <input type="text" class="form-control" name="idEmploye" placeholder="De l'Employe" required>
                                </div>
                            </div>
                            @if (session('erreur'))
                            <div class="alert alert-danger" role="alert">
                            <p>{{ session('erreur') }}</p>
                            </div>
                            @endif
                            <div class="modal-footer border-top-0 px-4 pt-0">
                                <button type="submit" class="btn btn-primary">Rechercher</button>
                            </div>
                        </form>
                        @else
                        <div class="contact-info px-4">
                            <hr>
                            <center><h2>{{ $besoin->poste->type }}</h2></center>
                            <center><p>Dans le domaine : <strong>{{ $besoin->service->type }}</strong></p></center>
                            <br>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Matricule: {{ $employe->id_emp }}</span></p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Nom</span>: {{ $employe->client->nom }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Prenom</span>: {{ $employe->client->prenom }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Date de Naissance</span>: {{ $employe->client->date_naissance }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">CIN</span>: {{ $employe->cin }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Telephone</span>: {{ $employe->telephone }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Situation Matrimonial</span>: {{ $situation_Matrimoniale->type }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Nombre d'enfant(s)</span>: {{ count($liste_enfants) }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Diplome: {{ $diplome->type }}</span></p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Experience: {{ $experience }}</span></p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Mission</span>: {{ $besoin->description }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Type Contrat</span>: {{ $besoin->type_contrat->nom }} | {{ $besoin->type_contrat->acronyme }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Superieur</span>: {{ $superieur->client->nom }} {{ $superieur->client->prenom }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Obligation</span>: {{ $contrat_Essaie->obligation }}</p>
                            <p><span class="text-dark font-weight-medium pt-4 mb-2">Lieu de Travail</span>: {{ $contrat_Essaie->lieu_travail->adresse }}</p>
                        </div>
                        <div class="modal-footer border-top-0 px-4 pt-0">
                            <a href="{{ route('recherche_un_personnel') }}"><button type="button" class="btn btn-primary">Terminer</button></a>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-xl-3"></div>
        </div>

    </div>
          
</div>


@endsection
