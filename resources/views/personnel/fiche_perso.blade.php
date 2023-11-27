@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                        <div class="card-body">
                            <div class="collapse" id="collapse-horizontal-validation"></div>
                            <div class="contact-info px-4">
                                <center><h2>Fiche Personnel</h2></center>
                                <br>
                                <p><span class="text-dark font-weight-medium pt-4 mb-2">Matricule: {{ $employe->id_emp }}</span></p>
                                @if($pere != null)
                                <p><span class="text-dark font-weight-medium pt-4 mb-2">Pere: </span>{{ $pere->nom }} {{ $pere->prenom }}</p>
                                @else
                                <p><span class="text-dark font-weight-medium pt-4 mb-2">Pere: </span>Null</p>
                                @endif

                                @if($mere != null)
                                <p><span class="text-dark font-weight-medium pt-4 mb-2">Mere: </span>{{ $mere->nom }} {{ $mere->prenom }}</p>
                                @else
                                <p><span class="text-dark font-weight-medium pt-4 mb-2">Mere: </span>Null</p>
                                @endif

                                @if($conjoint != null)
                                <p><span class="text-dark font-weight-medium pt-4 mb-2">Conjoint: </span>{{ $conjoint->nom }} {{ $conjoint->prenom }}</p>
                                @endif

                                <p><span class="text-dark font-weight-medium pt-4 mb-2">Nombre d'enfant(s): </span>{{ count($liste_enfants) }}</p>
                                <br>
                                @if(count($liste_enfants) > 0)
                                <h5>Liste de(s) enfant(s)</h5>
                                <div class="form-group row mb-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Date de Naissance</th>
                                                <th>Genre</th>
                                            </tr>
                                        </thead>
                                        <tbody id="line-container-age">
                                            @foreach($liste_enfants as $enfant)
                                            <tr id="tbody-age">
                                                <td>{{ $enfant->nom }}</td>
                                                <td>{{ $enfant->prenom }}</td>
                                                <td>{{ $enfant->dateDeNaissance }}</td>
                                                <td>{{ $enfant->genre->genre }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                        </div>
                        <div class="modal-footer border-top-0 px-4 pt-0">
                            <a href="{{ route('listes_personnels') }}"><button type="button" class="btn btn-primary">Retour</button></a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-3"></div>
        </div>

    </div>
          
</div>


@endsection
