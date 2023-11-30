@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Liste Proformat par fournisseur</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Ajouter un proformat
                </button>
            </div>

            <div class="card-body">
                <div class="accordion accordion-shadow" id="accordionShadow">

                    @foreach($fournisseurs as $fournisseur)
                        <div class="card">

                            <div class="card-header" id="heading{{ $fournisseur->getNomFournisseur() }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $fournisseur->getNomFournisseur() }}"
                                    aria-expanded="true" aria-controls="collapse{{ $fournisseur->getNomFournisseur() }}">
                                    Liste du proformat pour le fournisseur: {{ $fournisseur->getNomFournisseur() }}
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse{{ $fournisseur->getNomFournisseur() }}" class="collapse show" aria-labelledby="heading{{ $fournisseur->getNomFournisseur() }}" data-parent="#accordionShadow">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>ID Article</th>
                                                <th>Article</th>
                                                <th>Prix Unitaire HT</th>
                                                <th>TVA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($fournisseur->listeProformat as $proformat)
                                            <tr id="tbody-age">
                                                <th>{{ $proformat->date }}</th>
                                                <th>{{ $proformat->idArticle }}</th>
                                                <td>{{ $proformat->getArticle() }}</td>
                                                <td>{{ $proformat->prixUnitaire }}</td>
                                                <td>{{ $proformat->TVA }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>

    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('ajoutProformat') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Ajout Proformat</h5>
                    </div>
                    <input type="text" class="form-control"  name="idDemande" value="{{ $idDemande }}" hidden>
                    <div class="modal-body px-4">                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Date</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="date" class="form-control"  name="date" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Fournisseur</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <select name="idFournisseur" class="form-control" required>
                                        @foreach($fournisseurs as $fournisseur)
                                            <option value="{{ $fournisseur->idFournisseur }}">{{ $fournisseur->getNomFournisseur() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Prix HT</th>
                                        <th>TVA</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-article">
                                    <tr id="tbody-article">
                                        <td>
                                            <select name="idArticle[]" class="form-control">
                                                @foreach($articles as $article)
                                                    <option value="{{ $article->idArticle }}">{{ $article->article->article }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" id="prix[]" name="prix[]" placeholder="Prix unitaire"></td>
                                        <td><input type="text" class="form-control" id="tva[]" name="tva[]" placeholder="TVA du Produit"></td>
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
        var taille = <?php echo count($articles); ?>; 
        if(lines.length < taille) {
            var newLine = lines[lines.length - 1].cloneNode(true);

            var prix = newLine.querySelector("input[name='prix[]']");
            prix.value = "";

            var tva = newLine.querySelector("input[name='tva[]']");
            tva.value = "";

            container.appendChild(newLine);
        } 
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