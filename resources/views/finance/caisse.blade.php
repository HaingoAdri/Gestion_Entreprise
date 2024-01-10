@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        @if(session('erreur'))
        <div class="row mb-4 btn btn-danger" style="width: 100%;">{{ session('erreur') }}</div>
        @endif
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <div class="card-body">
                    <h2>Caisse</h2>
                    <button type="button" class="btn btn-primary" style="margin-left: 450px;" data-toggle="modal" data-target="#modal-add-contact"> 
                        Nouveau Caisse 
                    </button>
                    </div>
                </div>

                <div class="card-body">
                    <h4>Liste des caisses</h4>
                    <br>
                    <div class="collapse" id="collapse-horizontal-validation"></div>
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Caisse</th>
                                        <th>Nom</th>
                                        <th>Numero de compte</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeCaisse as $caisse)
                                    <tr>
                                        <th>{{ $caisse->id }}</th>
                                        <td>{{ $caisse->nom }}</td>
                                        <td>{{ $caisse->idCompte }}</td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('nouveauCaisse') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Creer un nouveau Caisse</h5>
                    </div>
                    <div class="modal-body px-4"> 
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Nom</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="text" class="form-control"  name="nom" placeholder="Nom de Caisse" required>
                                </div>
                            </div>
                        </div> 

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Numero de Compte</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="text" class="form-control"  name="idCompte" placeholder="Numero de compte a referencier" required>
                                </div>
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

</div>

@endsection