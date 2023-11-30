@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Listes des fournisseurs</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Ajouter un nouveau fournisseur
                </button>
            </div>

            <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Reponsable</th>
                                        <th>E-mail</th>
                                        <th>Adresse</th>
                                        <th>Telephone</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeFourisseur as $fournisseur)
                                    <tr id="tbody-age">
                                        <th>{{ $fournisseur->nom }}</th>
                                        <td>{{ $fournisseur->responsable }}</td>
                                        <td>{{ $fournisseur->email }}</td>
                                        <td>{{ $fournisseur->adresse }}</td>
                                        <td>{{ $fournisseur->telephone }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>

    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('ajoutFournisseur') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Ajout Nouveau fournisseur</h5>
                    </div>
                    <div class="modal-body px-4">                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Nom</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="text" class="form-control"  name="nom" placeholder="Nom de l'entreprise du fournisseur" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Reponsable</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="text" class="form-control"  name="responsable" placeholder="Reponsable au sein du fournisseur" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Email</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="email" class="form-control" name="email" placeholder="Adresse e-mail du fournisseur" required>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Adresse</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="text" class="form-control" name="adresse" placeholder="Adresse du fournisseur" required>
                                </div>
                            </div>
                        </div> 

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Telephone</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="text" class="form-control" name="telephone" placeholder="Numero telephone du fournisseur" required>
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

@endsection