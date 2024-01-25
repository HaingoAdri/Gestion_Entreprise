@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Liste Bon de commande terminser</h2>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Bon Commande</th>
                            <th>Nom</th>
                            <th>Date</th>
                            <th>Mode de Payement</th>
                            <th>Delai de livraison</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                        @foreach($liste_bon_commande as $bon)
                        <tr id="tbody-age">
                            <th>{{ $bon->id }}</th>
                            <td>{{ $bon->nom }}</td>
                            <td>{{ $bon->date }}</td>
                            <td>Par {{ $bon->getModePayement() }}</td>
                            <td>Apres {{ $bon->delaiLivarison }} jr(s)</td>
                            <td>
                            <a href="{{ route('voirPvReception', ['bon_commande' => $bon->id]) }}"><button type="button" class="btn btn-primary">Voir le PV de reception</button></a>
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