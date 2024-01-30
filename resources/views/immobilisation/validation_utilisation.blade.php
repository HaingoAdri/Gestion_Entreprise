@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Liste des proces verbal d'utilisation avec besoin de validation </h2>
            </div>

            <div class="card-body">
            <form action="{{ route('insert_valider_details_utilisation') }}" method="post">
                    @csrf
                <table class="table table-striped">
                    <thead>
                            <th></th>
                            <th>Id</th>
                            <th>Pv utilisation</th>
                            <th>Date</th>
                            <th>Pv Récéption</th>
                            <th>Etat</th>
                            <th>Article</th>
                            <th>Description</th>
                            <th>Module</th>
                        
                    </thead>
                    <tbody id="line-container-age">
                        @foreach($listeDemande as $index => $immo)
                        <tr>
                            <td><input type="checkbox" name="c[]" class="form-check" value="{{ $index }}"></td>
                            <td>{{ $immo->iddu }} <input type="hidden" name="id[{{ $index }}]" value="{{ $immo->iddu }}"></td>
                            <td>{{ $immo->id }}</td>
                            <td>{{ $immo->date }}</td>
                            <td>{{ $immo->reception }}</td>
                            <td>{{ $immo->type_etat }}</td>
                            <td>{{ $immo->immobilisation }}</td>
                            <td>{{ $immo->description }}</td>
                            <td>{{ $immo->type }}</td>
                        </tr>
                        @endforeach    
                    </tbody>
                    </table>
                    <p></p>
                    <input type="submit" class="btn btn-primary text-end" value="Insérer"/>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection