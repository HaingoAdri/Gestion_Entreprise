@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        @if(session('erreur'))
        <div class="row mb-4 btn btn-danger" style="width: 100%;">{{ session('erreur') }}</div>
        @endif
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Magasin</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Nouveau Magasin 
                </button>
            </div>

            <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Magasin</th>
                                        <th>Nom</th>
                                        <th>Leu</th>
                                        <th>Date de Creation</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeMagasin as $magasin)
                                    <tr>
                                        <td>{{ $magasin->id }}</td>
                                        <td>{{ $magasin->nom }}</td>
                                        <td>{{ $magasin->lieu }}</td>
                                        <td>{{ $magasin->date }}</td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
        </div>

    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('nouveauMagasin') }}">
                @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Creer un nouveau Magasin</h5>
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
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Nom</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="text" class="form-control"  name="nom" placeholder="Nom du magasin" required>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Lieu</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="text" class="form-control"  name="lieu" placeholder="Lieu du magasin" required>
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