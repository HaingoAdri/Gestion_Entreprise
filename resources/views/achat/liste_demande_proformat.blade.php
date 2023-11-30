@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Liste demande en attente de proformat</h2>
            </div>

            <div class="card-body">
                <div class="collapse" id="collapse-horizontal-validation"></div>
                    <div class="form-group row mb-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Demande</th>
                                    <th>Date</th>
                                    <th>Nom</th>
                                </tr>
                            </thead>
                            <tbody id="line-container-age">
                                @foreach($listeDemande as $demande)
                                <tr id="tbody-age">
                                    <th>{{ $demande->idDemande }}</th>
                                    <td>{{ $demande->date }}</td>
                                    <td>{{ $demande->nom }}</td>
                                    <td>
                                    <a href="{{ route('detailsProformat', ['idDemande' => $demande->idDemande]) }}"><button type="button" class="btn btn-primary">Details</button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection