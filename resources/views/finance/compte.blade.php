@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        @if(session('erreur'))
        <div class="row mb-4 btn btn-danger" style="width: 100%;">{{ session('erreur') }}</div>
        @endif
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Compte</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Ajouter un compte
                </button>
            </div>

            <div class="card-body">
                    <h4>Liste des comptes</h4>
                    <br>
                    <div class="collapse" id="collapse-horizontal-validation"></div>
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Numero Compte</th>
                                        <th>Nom</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeCompte as $compte)
                                    <tr id="tbody-age">
                                        <th>{{ $compte->id }}</th>
                                        <td>{{ $compte->nom }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>

    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('ajoutCompte') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Ajout nouveau compte</h5>
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

@endsection