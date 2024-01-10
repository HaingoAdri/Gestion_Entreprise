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
                    <h2>Magasin</h2>
                    <button type="button" class="btn btn-primary" style="margin-left: 500px;" data-toggle="modal" data-target="#modal-add-contact"> 
                        Nouveau Caisse Magasin 
                    </button>
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        <form method="GET" action="{{ route('voirCaisseMagasin') }}">
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Voir liste caisse par Magasin</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="form-group">
                                    <label for="lastName">Magasin</label>
                                    <select name="idMagasin" class="form-control" required>
                                        <option value="">Magasin</option>
                                        @foreach($listeMagasin as $m)
                                        <option value="{{ $m->id }}">{{ $m->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer border-top-0 px-4 pt-0">
                                <button type="submit" class="btn btn-primary">Voir</button>
                            </div>
                        </form>
                    </div>
                

            <div class="card-body">
                @if($magasin != null)
                <div class="collapse" id="collapse-horizontal-validation"></div>
                    <p style="color: black;">ID Magasin: {{ $magasin->id }}</p>
                    <p style="color: black;">Nom: {{ $magasin->nom }}</p>
                    <p style="color: black;">Lieu: {{ $magasin->lieu }}</p>
                    <br>
                    <div class="form-group row mb-8">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Caisse</th>
                                    <th>Nom</th>
                                    <th>Numero de compte</th>
                                </tr>
                            </thead>
                            <tbody id="line-container-age">
                                @foreach($magasin->listeCaisse as $caisse)
                                <tr>
                                    <td>{{ $caisse->id }}</td>
                                    <td>{{ $caisse->nom }}</td>
                                    <td>{{ $caisse->idCompte }}</td>
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

    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('nouveauCaisseMagasin') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Creer un nouveau Magasin</h5>
                    </div>
                    <div class="modal-body px-4">                        
                        <div class="form-group row mb-6">
                            <label for="lastName">Magasin</label>
                            <select name="idMagasin" class="form-control" required>
                                <option value="">Magasin</option>
                                @foreach($listeMagasin as $m)
                                <option value="{{ $m->id }}">{{ $m->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Caisse</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="text" class="form-control"  name="idCaisse" placeholder="Numero de Caisse" required>
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