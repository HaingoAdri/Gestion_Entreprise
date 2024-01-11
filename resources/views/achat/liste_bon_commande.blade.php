@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        @if(session('erreur'))
        <div class="row mb-4 btn btn-danger" style="width: 100%;">{{ session('erreur') }}</div>
        @endif
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
                        <?php $count = 0; ?>
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
                            @if(session("administrateur_rh")->module->id == 1)
                            <a href="{{ route('validerUnBonCommandeEnAttente', ['idBonCommande' => $bon->id, 'date' => $bon->date, 'etat' => $bon->etat]) }}"><button type="button" class="btn btn-primary">Valider</button></a>
                            @endif
                            @if(session("administrateur_rh")->module->id == 7)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact" onclick="valider('<?php echo $bon->id; ?>', '<?php echo $bon->date; ?>', '<?php echo $bon->etat; ?>')">Valider</button>
                            @endif

                            @if($bon->etat == 37)
                            <a href="{{ route('passerUnBonCommande', ['idBonCommande' => $bon->id, 'date' => $bon->date, 'etat' => $bon->etat]) }}"><button type="button" class="btn btn-primary">Faire</button></a>
                            @endif
                            @if($bon->etat == 40) 
                            <!-- <a href="{{ route('passerUnBonCommande', ['idBonCommande' => $bon->id, 'date' => $bon->date, 'etat' => $bon->etat]) }}"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact">Terminer</button></a> -->
                            @endif
                            </td>
                        </tr>
                        <?php $count++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="GET" action="{{ route('validerUnBonCommandeEnAttente') }}">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Veuillez remplir l'information suivant:</h5>
                    </div>
                    <input type="date" class="form-control"  id="date" name="date" hidden>
                    <input type="text" class="form-control"  id="idBonCommande" name="idBonCommande" placeholder="Numero Bon de commande" hidden>
                    <input type="text" class="form-control"  id="etat" name="etat" placeholder="Etat du Bon de commande" hidden>
                    <div class="modal-body px-4">    

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Numero de compte</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                <input type="text" class="form-control"  name="idCompte" placeholder="Pour payer le bon de commande" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-smoke" data-dismiss="modal">Anuler</button>
                            <button type="submit" class="btn btn-primary">Creer</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script defer>
    function valider(idBonCommande, date, etat) {
        var InputId = document.getElementById("idBonCommande");
        InputId.value = idBonCommande;
        var InputDate =  document.getElementById("date");
        InputDate.value = date;
        var InputEtat = document.getElementById("etat");
        InputEtat.value = etat;
        console.log(idBonCommande + " " + date + " " + etat);

}
</script>

@endsection