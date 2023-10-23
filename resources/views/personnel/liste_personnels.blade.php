@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-xl-12">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Liste des Personnels</h2>
                    </div>
                <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Nom et Prenom</th>
                                        <th>Date de Naissance</th>
                                        <th>Genre</th>
                                        <th>Date d'Embauche</th>
                                        <th>Direction</th>
                                        <th>Poste</th>
                                        <th>Capacite</th>
                                        <th>Retraite?</th>
                                        <th>Fiche Personnel</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($liste as $employe)
                                    <tr id="tbody-age">
                                        <th>{{ $employe["employe"]->id_emp }}</th>
                                        <td>{{ $employe["employe"]->client->nom }} {{ $employe["employe"]->client->prenom }}</td>
                                        <td>{{ $employe["employe"]->client->date_naissance }}</td>
                                        <td>{{ $employe["employe"]->client->genre->genre }}</td>
                                        <td>{{ $employe["historique_embauche"]->date }}</td>
                                        <td>{{ $employe["besoin"]->service->type }}</td>
                                        <td>{{ $employe["besoin"]->poste->type }}</td>
                                        <td>{{ $employe["capacite"] }}</td>
                                        <td>{{ $employe["retraite"] }}</td>
                                        <td><div class="modal-footer border-top-0 px-4 pt-0">
                                            <a href="{{ route('recherche_un_personnel') }}"><button type="button" class="btn btn-primary">Fiche</button></a>
                                        </div></td>
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
          
</div>
@endsection
