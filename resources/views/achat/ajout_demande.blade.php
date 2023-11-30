@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Faire une demande de proformat</h2>
            </div>

            <div class="card-body" style="padding: 0 13rem;">
                <form method="POST" action="{{ route('demandeProformat') }}">
                    @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Demande de proforrmat</h5>
                    </div>
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
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">ID du Dmenade</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                <input type="text" class="form-control"  name="idDemande" value="{{ $idDemande }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Nom</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                <input type="text" class="form-control" name="nom" placeholder="Nom du demande" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fournisseur</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-fournisseur">
                                    <tr id="tbody-fournisseur">
                                        <td>
                                            <select name="fournisseur[]" class="form-control">
                                                @foreach($listeFourisseur as $fournisseur)
                                                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-smoke" data-dismiss="modal" id="ajout">Ajouter nouvelle ligne</button>
                        <button type="button" class="btn btn-smoke" data-dismiss="modal" id="supprimer">Supprimer ligne</button>

                    </div>
                    <div class="modal-footer px-4">
                        <button type="submit" class="btn btn-primary">Demande</button>
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
        var container = document.getElementById("line-container-fournisseur");
        var lines = document.querySelectorAll("#tbody-fournisseur");
        var newLine = lines[lines.length - 1].cloneNode(true);

        container.appendChild(newLine);
    }

   function supprimerLigne(){
       document.getElementById("line-container-fournisseur").deleteRow(1);
   }

</script>


@endsection