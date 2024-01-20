@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Besoin d'achat</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Ajouter vos besoins achat
                </button>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-immobilisation"> 
                    Ajouter vos besoins d'immmobilisation
                </button>
            </div>

            <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>ID Article</th>
                                        <th>Article</th>
                                        <th>Quantite</th>
                                        <th>Description</th>
                                        <th>Etat</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeBesoinNonValide as $besoin)
                                    <tr id="tbody-age">
                                        <td>{{ $besoin->date }}</td>
                                        <th>{{ $besoin->idArticle }}</th>
                                        <td>{{ $besoin->article->article }}</td>
                                        <td>{{ $besoin->nombre }}</td>
                                        <td>{{ $besoin->description }}</td>
                                        <td>{{ $besoin->getEtat() }}</td>
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
                <form action="{{ route('ajoutBesoinAchat') }}">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Ajout Besoin d'Achat</h5>
                    </div>
                    <div class="modal-body px-4">
                        <input type="text" class="form-control"  name="idModule" value="{{ $module }}" hidden>
                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Date</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="date" class="form-control"  name="date" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Article</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <select name="idArticle" class="form-control" required>
                                        @foreach($listeArticle as $article)
                                            <option value="{{ $article->id }}">{{ $article->article }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Quantite</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="text" class="form-control" name="quantite" placeholder="Quantite de votre article" required>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Description</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="text" class="form-control" name="description" placeholder="Notif de votre demande" required>
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

    <div class="modal fade" id="modal-add-immobilisation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('ajoutBesoinImmobilisation') }}">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Ajout Besoin d'Immobilisation</h5>
                    </div>
                    <div class="modal-body px-4">
                        <input type="text" class="form-control"  name="idModule" value="{{ $module }}" hidden>
                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Date</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="date" class="form-control"  name="date" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Type Immobilisation</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <select name="idArticle" class="form-control" required>
                                        @foreach($typeImmobisation as $article)
                                            <option value="{{ $article->id }}">{{ $article->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Quantite</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="text" class="form-control" name="quantite" placeholder="Quantite de votre article" required>
                                </div>
                            </div>
                        </div>    
                        
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Description</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="text" class="form-control" name="description" placeholder="Notif de votre demande" required>
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