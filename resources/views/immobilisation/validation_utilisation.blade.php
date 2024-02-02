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
                            <th>Date</th>
                            <th>Immobilisation</th>
                            <th>Etat</th>
                            <th>Employer</th>
                        
                    </thead>
                    <tbody id="line-container-age">
                        @foreach($listeDemande as $index => $immo)
                        <tr>
                            <td><input type="checkbox" name="c[]" class="form-check" value="{{ $index }}"></td>
                            <td>{{ $immo->id }} <input type="hidden" name="id[{{ $index }}]" value="{{ $immo->id }}"></td>
                            <td>{{ $immo->date }}<input type="hidden" name="date[{{ $index }}]" value="{{ $immo->date }}"></td>
                            <td>{{ $immo->immmobilisation }} <input type="hidden" name="immobilisation[{{ $index }}]" value="{{ $immo->immmobilisation }}"></td>
                            <td>{{ $immo->etat_immobilisation }}<input type="hidden" name="etats[{{ $index }}]" value="{{ $immo->etat_immobilisation }}"></td>
                            <td>{{ $immo->id_employer }}</td>
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