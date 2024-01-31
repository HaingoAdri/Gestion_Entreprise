@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        
        <div class="card card-default">
            <div class="card-body">
                <div class="mb-5">
                    <h5 class="text-dark mb-3">Liste des inventaire</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Immobilisation</th>
                                <th scope="col">Etat Immobilisation</th>
                                <th scope="col">Taux</th>
                                <th scope="col">Ammortissement</th>
                                <th scope="col">Type inventaire (origine)</th>
                                <th scope="col">Libeller</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listeInventaire as $etat)
                            <tr>
                                <td>{{ $etat->date}}</td>
                                <td>{{ $etat->immobilisation}}</td>
                                <td>{{ $etat->etat_immobilisation}}</td>
                                <td>{{ $etat->taux}}</td>
                                <td>{{ $etat->ammortissement}}</td>
                                <td>{{ $etat->type_inventaire}}</td>
                                <td>{{ $etat->libeller}}</td>
                                <td>{{ $etat->description}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
