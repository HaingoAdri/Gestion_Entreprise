@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Liste de(s) Contrat(s) A Renouveler</h2>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapse-horizontal-validation"></div>
                        <div class="form-group row mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Numero de Matricule</th>
                                        <th>Nom et Prenom</th>
                                        <th>Date Fin Essaie</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @for($i = 0; $i <count($listes_contrats); $i++) 
                                    <tr id="tbody-age">
                                        <td>{{ $listes_employees[$i]->id_emp }}</td>
                                        <td>{{ $listes_employees[$i]->client->nom }} {{ $listes_employees[$i]->client->prenom }}</td>
                                        <td>{{ $listes_contrats[$i]->date_fin }}</td>
                                        <td><a href="{{ route('renouveler_un_contrat',  ['idEmploye' => $listes_employees[$i]->id_emp, 'date' => $dateDuSysteme]) }}"><button type="button" class="btn btn-primary">Renouveler</button></a></td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-3"></div>
        </div>

    </div>
          
</div>


@endsection
