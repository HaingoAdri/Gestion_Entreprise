@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Listes en cours des maintenances des immobilisations</h2>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Reference immobilisation</th>
                            <th>Date debut</th>
                            <th>Etat</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                        @foreach($listeMaintenance as $maintenance)
                        <tr id="tbody-age">
                            <th>{{ $maintenance->id_maintenance }}</th>
                            <td>{{ $maintenance->id_immobilisation_reception }}</td>
                            <td>{{ $maintenance->debut_maintenance }}</td>
                            <td>En cours</td>
                            <td>
                            <a href="{{ route('terminer_maintenance_form', ['id_maintenance' => $maintenance->id_maintenance, 'id_immobilisation' => $maintenance->id_immobilisation_reception]) }}"><button type="button" class="btn btn-primary">Terminer</button></a>
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