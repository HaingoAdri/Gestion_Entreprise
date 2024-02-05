@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Tableau d'ammortissement pour l'annee {{}}</h2>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Taux</th>
                            <th>Date d'utilisation</th>
                            <th>Valeur brute</th>
                            <th>Ammortissement cumule debut periode</th>
                            <th>Dotation</th>
                            <th>Ammortissement cumule fin periode</th>
                            <th>Valeur net comptable</th>
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
                            <td>{{ $pv->quantite }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection