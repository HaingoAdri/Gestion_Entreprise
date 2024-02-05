@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Listes des maintenances terminer</h2>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Reference immobilisation</th>
                            <th>Date debut</th>
                            <th>Date fin</th>
                            <th>Prochain entretien</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                        @foreach($listeMaintenance as $maintenance)
                        <tr id="tbody-age">
                            <th>{{ $maintenance->id_maintenance }}</th>
                            <td>{{ $maintenance->id_immobilisation_reception }}</td>
                            <td>{{ $maintenance->debut_maintenance }}</td>
                            <td>{{ $maintenance->fin_maintenance }}</td>
                            <td>{{ $maintenance->date_prochain_entretient }}</td>
                            <td>{{ $maintenance->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection