@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Liste des proces verbal de reception pour le bon de commande numero {{ $liste_pv_reception[0]->id_bon_commande }}</h2>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Code</th>
                            <th>Immobilisation</th>
                            <th>Livreur</th>
                            <th>Article</th>
                            <th>Quantite</th>
                            <th>Ammortissement</th>
                            <th>Taux</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                        @foreach($liste_pv_reception as $pv)
                        <tr id="tbody-age">
                            <th>{{ $pv->id }}</th>
                            <td>{{ $pv->date }}</td>
                            <td>{{ $pv->code }}</td>
                            <td>{{ $pv->nom_immobilisation }}</td>
                            <td>{{ $pv->livreur->nom }}</td>
                            <td>{{ $pv->id_article }}</td>
                            <td>{{ $pv->quantite }}</td>
                            <td>{{ $pv->nom_ammortissement }}</td>
                            <td>{{ $pv->taux }} </td>
                            <td>
                            <a href="#"><button type="button" class="btn btn-primary">Details</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection