@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Liste Besoin d'achat Non Valide</h2>
            </div>

            <div class="card-body">
                <div class="collapse" id="collapse-horizontal-validation"></div>
                    <div class="form-group row mb-6">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>ID Article</th>
                                    <th>Article</th>
                                    <th>Quantite</th>
                                    <th>Description</th>
                                    <th>Module</th>
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
                                    <td>{{ $besoin->getModule() }}</td>
                                    <td><a href="{{ route('refuserUneBesoinAchat', ['idBesoinAchat' => $besoin->id]) }}"><button type="submit" class="btn btn-primary">Refuser</button></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <a href="{{ route('listeBesoinAchatNonValide') }}"><button type="button" class="btn btn-primary"> 
                        Retour
                    </button></a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection