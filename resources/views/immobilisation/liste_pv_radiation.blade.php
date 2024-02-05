@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Liste de pv de radiation</h2>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Immobilisation eradier</th>
                            <th>Cause</th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                            @foreach($pv_radiation as $immo)
                            <tr>
                                <td>{{ $immo->id }}</td>
                                <td>{{ $immo->date }}</td>
                                <td>{{ $immo->immobilisation }}</td>
                                <td>{{ $immo->cause }}</td>
                            </tr> 
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection