@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                @if(session("administrateur_rh")->module->id == 1 || session("administrateur_rh")->module->id == 7)
                <h2>Liste Bon de commande a valider</h2>
                @elseif(count($listeBonCommande) !=0 && $listeBonCommande[0]->etat == 40)
                <h2>Liste Bon de commande en cours</h2>
                @else
                <h2>Liste Bon de commande en attente</h2>
                @endif
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
                            @if(session("administrateur_rh")->module->id == 8 && count($listeBonCommande) !=0 && $listeBonCommande[0]->etat < 37)
                            <th>Etat</th>
                            @endif
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                        @foreach($listeBonCommande as $bon)
                        <tr id="tbody-age">
                            <th>{{ $bon->id }}</th>
                            <td>{{ $bon->nom }}</td>
                            <td>{{ $bon->date }}</td>
                            <td>Par {{ $bon->getModePayement() }}</td>
                            <td>Apres {{ $bon->delaiLivarison }} jr(s)</td>
                            @if(session("administrateur_rh")->module->id == 8 && count($listeBonCommande) !=0 && $listeBonCommande[0]->etat < 37)
                            <td>{{ $bon->getEtat() }}</td>
                            @endif
                            <td>
                            <a href="{{ route('voirBonDeCommande', ['idBonCommande' => $bon->id]) }}"><button type="button" class="btn btn-primary">Details</button></a>
                            @if(session("administrateur_rh")->module->id == 1 || session("administrateur_rh")->module->id == 7)
                            <a href="{{ route('validerUnBonCommandeEnAttente', ['idBonCommande' => $bon->id]) }}"><button type="button" class="btn btn-primary">Valider</button></a>
                            @endif
                            @if($bon->etat == 37)
                            <a href="{{ route('passerUnBonCommande', ['idBonCommande' => $bon->id]) }}"><button type="button" class="btn btn-primary">Faire</button></a>
                            @endif
                            @if($bon->etat == 40)
                            <a href="{{ route('passerUnBonCommande', ['idBonCommande' => $bon->id]) }}"><button type="button" class="btn btn-primary">Terminer</button></a>
                            @endif
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