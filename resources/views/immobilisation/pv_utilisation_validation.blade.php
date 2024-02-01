@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center  px-3 px-md-5">
                <h2>Details des proces verbal d'utilisation avec besoin de validation </h2>
            </div>

            <div class="card-body">
            <form action="{{ route('insert_details_utilisation') }}" method="post">
                    @csrf
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Id immobilisation</th>
                            <th>Date</th>
                            <th>Employer</th>
                            <th>Etat</th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                            @foreach($reception as $index => $immo)
                            <tr>
                                <td><input type="checkbox" name="c[]" class="form-check" value="{{ $index }}"> </td>
                                <td>{{ $immo->id_immobilisation }}
                                <input type="hidden" name="id[{{ $index }}]" value="{{ $immo->id_immobilisation }}"></td>

                                <td><input type="date" name="date[{{ $index }}]" class="form-control"></td>
                                <td>
                                    <input type="text" name="employer[{{ $index }}]" class="form-control">
                                </td>
                                <td>
                                    <select name="etats[{{ $index }}]" id="" class=form-control>
                                        @foreach($listeEtat as $etat)
                                        <option value="{{$etat->id}}">{{$etat->nom}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-primary text-end" value="Insérer"/>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection