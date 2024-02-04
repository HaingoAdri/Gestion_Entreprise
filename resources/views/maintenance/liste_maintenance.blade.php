@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Listes des maintenances des immobilisations</h2>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Reference Immobilisation</th>
                            <th>Reference Reception</th>
                            <th>Date</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                        @foreach($listeImmobilisationInutilisable as $immobilisation)
                        <tr id="tbody-age">
                            <th>{{ $immobilisation->id_immobilisation }}</th>
                            <td>{{ $immobilisation->id_pv_reception }}</td>
                            <td>{{ $immobilisation->dernier_date }}</td>
                            <td>
                            <a href="{{ route('insert_maintenance_form', ['id_immoblisation_reception' => $immobilisation->id_immobilisation]) }}"><button type="button" class="btn btn-primary">Maintenir</button></a>
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