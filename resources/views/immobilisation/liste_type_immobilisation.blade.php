@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Voir liste des Sous Categories d'un Type Immobilisation</h2>
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Ajouter un sous categorie
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-type"> 
                    Ajouter un nouveau type
                </button>
                <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>
                        <form method="GET" action="{{ route('listeTypeImmobilisation') }}">
                            <div class="modal-body px-2">
                                <div class="form-group">
                                    <label for="lastName">Type</label>
                                    <select name="idType" class="form-control" required>
                                        <option value="">Type</option>
                                        @foreach($types as $_type)
                                            <option value="{{ $_type->id }}">{{ $_type->id }} : {{ $_type->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer border-top-0 px-4 pt-0">
                                <button type="submit" class="btn btn-primary">Voir</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if($type->id != "")
                        <p style="color: black;">Numero de compte: {{ $type->id }}</p>
                        <p style="color: black;">Type: {{ $type->nom }}</p>
                        <br>
                        <div class="form-group row mb-8">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Numero Identifiant</th>
                                        <th>Sous Categorie</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($type->listeSousCategorie as $categorie)
                                    <tr>
                                        <td>{{ $categorie->id }}</td>
                                        <td>{{ $categorie->categorie }}</td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('ajoutSousCategorie') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Ajout sous categorie</h5>
                    </div>
                    <div class="modal-body px-4">  
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Categorie</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <label for="lastName">Type</label>
                                    <select name="idType" class="form-control" required>
                                        <option value="">Type</option>
                                        @foreach($types as $_type)
                                            <option value="{{ $_type->id }}">{{ $_type->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Categorie</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <select name="idCategorie" class="form-control" required>
                                        <option value="">Categorie</option>
                                        @foreach($listeCategorie as $categorie_)
                                            <option value="{{ $categorie_->id }}">{{ $categorie_->categorie }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-smoke" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Suivant</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-type" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('nouveauTypeImmobilisation') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Ajout nouveau type</h5>
                    </div>
                    <div class="modal-body px-4">                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Numero</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="text" class="form-control"  name="id" placeholder="Numero du compte" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Nom</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="text" class="form-control"  name="nom" placeholder="Nom du compte" required>
                                </div>
                            </div>
                        </div>                     

                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pill">Suivant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<script defer>

    // Empêche le bouton "Ajouter nouvelle ligne" de fermer le modal
    document.querySelector("#ajout").addEventListener("click", function (e) {
        e.stopPropagation();
    });

    // Empêche le bouton "Supprimer ligne" de fermer le modal
    document.querySelector("#supprimer").addEventListener("click", function (e) {
        e.stopPropagation();
    });

</script>

@endsection