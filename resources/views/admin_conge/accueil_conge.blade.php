@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content"><!-- Card Profile -->
        <div class="card card-default card-profile">

        <div class="card-footer card-profile-footer">
            <ul class="nav nav-border-top justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('accueil_Conge') }}">Types de conges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('liste_demande') }}">Demandes de Conges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('liste_valider') }}">Confirmation Depart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('liste_retour') }}">Confirmation Fin</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card card-default border-0 bg-transparent">
            <div class="card-header align-items-center p-0">
                <h2>Ajouter un type de conge</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-event">
                    <i class="mdi mdi-plus mr-1"></i> Une nouveau type
                </button>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="mb-5">
                    <h5 class="text-dark mb-3">Liste des types de conge</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Politique</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($listeTypeConges) > 0)
                                @foreach($listeTypeConges as $type_conge)
                                <tr>
                                    <td scope="row">{{ $type_conge->id }}</td>
                                    <td>{{ $type_conge->nom }}</td>
                                    <td>{{ $type_conge->politique }}</td>
                                </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>

        <!-- Add Event Button  -->
        <div class="modal fade" id="modal-add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('insertion_type_conge') }}">
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter une nouvelle type de conge</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body px-4">

                            <div class="form-group">
                                <label for="firstName">Nom</label>
                                <input type="text" class="form-control" name="nom" placeholder="ex: Maternite">
                            </div>
                            <div class="form-group">
                                <label for="firstName">Politique</label>
                                <input type="text" class="form-control" name="politique" placeholder="Politique de confidentialite">
                            </div>

                            <div class="form-group">
                                <label for="firstName">Commentaires</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="commentaires"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="firstName">Jour par defaut</label>
                                <input type="number" class="form-control" name="day_default" placeholder="0">
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
@endsection