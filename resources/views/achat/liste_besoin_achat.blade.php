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
                    <div class="form-group row mb-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Article</th>
                                    <th>Article</th>
                                    <th>Quantite</th>
                                </tr>
                            </thead>
                            <tbody id="line-container-age">
                                @foreach($listeBesoinNonValide as $besoin)
                                <tr id="tbody-age">
                                    <th>{{ $besoin->idArticle }}</th>
                                    <td>{{ $besoin->article->article }}</td>
                                    <td>{{ $besoin->nombre }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(count($listeBesoinNonValide) > 0)
                <div class="modal-footer px-4">
                    <a href="{{ route('detailsBesoinAchat') }}"><button type="button" class="btn btn-primary"> 
                        Details
                    </button></a>
                    <a href="{{ route('faireUneDemande', ['isImmobilier' => false]) }}"><button type="button" class="btn btn-primary"> 
                        Faire une demande
                    </button></a>
                </div>
                @endif
            </div>
        </div>

        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Liste Besoin Immobilier non valide</h2>
            </div>

            <div class="card-body">
                <div class="collapse" id="collapse-horizontal-validation"></div>
                    <div class="form-group row mb-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Immobilier</th>
                                    <th>Immobilier</th>
                                    <th>Description</th>
                                    <th>Quantite</th>
                                </tr>
                            </thead>
                            <tbody id="line-container-age">
                                @foreach($listeBesoinImmobilierNonValide as $besoin)
                                <tr id="tbody-age">
                                    <th>{{ $besoin->idArticle }}</th>
                                    <td>{{ $besoin->article->article }}</td>
                                    <th>{{ $besoin->description }}</th>
                                    <td>{{ $besoin->nombre }}</td>
                                    <td><a href="{{ route('refuserUneBesoinImmobilier', ['idBesoinImmobilier' => $besoin->id]) }}"><button type="submit" class="btn btn-primary">Refuser</button></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(count($listeBesoinImmobilierNonValide) > 0)
                <div class="modal-footer px-4">
                    <a href="{{ route('faireUneDemande', ['isImmobilier' => true]) }}"><button type="button" class="btn btn-primary"> 
                        Faire une demande
                    </button></a>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection