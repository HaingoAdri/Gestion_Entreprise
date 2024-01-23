@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Voir liste description par Type</h2>
                
                <button type="button" class="btn btn-primary" style="margin-left: 500px;" data-toggle="modal" data-target="#modal-add-contact"> 
                    Ajouter description
                </button>
                <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>
                        <form method="GET" action="{{ route('listeDescriptionParType') }}">
                            <div class="modal-body px-2">
                                <div class="form-group">
                                    <label for="lastName">Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="">Type</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->nom }}</option>
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
                    @if(count($descriptions) > 0)
                        <p style="color: black;">Numero de compte: {{ $descriptions[0]->id }}</p>
                        <p style="color: black;">Compte: {{ $descriptions[0]->nom }}</p>
                        <br>
                        <div class="form-group row mb-8">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Desciption</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($descriptions as $description)
                                    <tr>
                                        <td>{{ $description->description }}</td>
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
                <form method="POST" action="{{ route('ajoutDescripcion') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Ajout description</h5>
                    </div>
                    <div class="modal-body px-4">  

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Type</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <select name="type" class="form-control" required>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-article">
                                    <tr id="tbody-article">
                                        <td><input type="text" class="form-control" id="description[]" name="description[]" placeholder="Description" required></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            <button type="button" class="btn btn-smoke" data-dismiss="modal" id="ajout">Ajouter nouvelle ligne</button>
                            <button type="button" class="btn btn-smoke" data-dismiss="modal" id="supprimer">Supprimer ligne</button>

                        </div>

                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-smoke" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Suivant</button>
                        </div>
                </form>
            </div>
        </div>
    </div>


</div>

<script defer>
   
   document.querySelector("#ajout").addEventListener("click", () => {
        ajoutLigne();
    });

    document.querySelector("#supprimer").addEventListener("click", () => {
        supprimerLigne();
    });

    function ajoutLigne() {
        var container = document.getElementById("line-container-article");
        var lines = document.querySelectorAll("#tbody-article");
        var newLine = lines[lines.length - 1].cloneNode(true);
        container.appendChild(newLine);
    }

   function supprimerLigne(){
        var lines = document.querySelectorAll("#tbody-article");
        var taille = lines.length;
        if(taille > 1)
            document.getElementById("line-container-article").deleteRow(taille-1);
   }

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