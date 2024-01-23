@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default border-0 bg-transparent">
            <div class="card-header align-items-center p-0">
                <h2>Entrer un Etat</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-event">
                    <i class="mdi mdi-plus mr-1"></i> Une nouvelle etat
                </button>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="mb-5">
                    <h5 class="text-dark mb-3">Liste des etats actuelles</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listeEtats as $etat)
                            <tr>
                                <td scope="row">{{ $etat->id}}</td>
                                <td>{{ $etat->nom}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>

        <!-- Add Event Button  -->
        <div class="modal fade" id="modal-add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('insert_etat_immobilisation') }}">
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter une nouvelle etat</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body px-4">
                            
                            <div class="form-group">
                                <label for="firstName">Nom</label>
                                <input type="text" class="form-control" name="nom">
                            </div>
                        
                        </div>

                        <div class="modal-footer border-top-0 px-4 pt-0">
                            <button type="submit" class="btn btn-primary btn-pill m-0">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection