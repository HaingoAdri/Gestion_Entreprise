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
                        <h2>Contrat d'essaie</h2>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        @if(count($liste_nouveau_employer) > 0)
                        <form method="POST" action="{{ route('ajout_contrat_essaie') }}">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Creer une nouvelle contrat</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="form-group">
                                    <label for="lastName">Nouveau Employe</label>
                                    <select name="idEmploye" class="form-control" required>
                                        <<option value="">Employe</option>
                                        @foreach($liste_nouveau_employer as $employe)
                                            <option value="{{ $employe->id_emp }}">{{ $employe->client->prenom }} {{ $employe->client->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="firstName">CIN</label>
                                    <input type="text" class="form-control" name="cin" placeholder="Numero CIN" required>
                                </div>

                                <div class="form-group">
                                    <label for="firstName">Telephone</label>
                                    <input type="text" class="form-control" name="telephone" placeholder="Numero Telephone" required>
                                </div>

                                <div class="form-group">
                                    <label for="firstName">Adresse</label>
                                    <input type="text" class="form-control" name="adresse" placeholder="Adresse de l'employe" required>
                                </div>

                                <div class="form-group">
                                    <label for="firstName">Date Debut Essaie</label>
                                    <input type="date" class="form-control" name="dateDebut" required>
                                </div>

                                <div class="form-group">
                                    <label for="firstName">Date Fin Essaie</label>
                                    <input type="date" class="form-control" name="dateFin" required>
                                </div>

                                <div class="form-group">
                                    <label for="lastName">Lieu de Travail</label>
                                    <select name="idLieu" class="form-control" required>
                                        <option value="">Adresse</option>
                                        @foreach($Liste_Adresse_entreprise as $adresse)
                                            <option value="{{ $adresse->id }}">{{ $adresse->adresse }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="modal-footer border-top-0 px-4 pt-0">
                                <button type="submit" class="btn btn-primary btn-pill m-0">Ajouter</button>
                            </div>
                        </form>
                        @else 
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Il n'y a pas de contrat d'essaie a creer pour le moment</h5>
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
