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
                            <th>Id</th>
                            <th>Date</th>
                            <th>Pv Récéption</th>
                            <th>Etat</th>
                            <th>Article</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="line-container-age">
                            @foreach($listeImmo as $index => $immo)
                            <tr>
                                <td><input type="checkbox" name="c[]" class="form-check" value="{{ $index }}"></td>
                                <td>{{ $id }} <input type="hidden" name="id[{{ $index }}]" value="{{ $id }}"></td>
                                <td>{{ $date }}<input type="hidden" name="date[{{ $index }}]" value="{{ $date }}"></td>
                                <td>{{ $reception }}<input type="hidden" name="reception[{{ $index }}]" value="{{ $reception }}"></td>
                                <td>
                                    <select name="etats[{{ $index }}]" id="" class=form-control>
                                        @foreach($listeEtat as $etat)
                                        <option value="{{$etat->id}}">{{$etat->nom}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" name="article[{{ $index }}]" value="{{ $immo->id_immobilisation }}">
                                    {{ $immo->id_immobilisation }}
                                </td>
                                <td><textarea name="description[{{ $index }}]" placeholder="Description de l'article" class="form-control"></textarea></td>
                                <td></td>
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