@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    
    <div class="content">
        <div class="row">
            <div class="col-md-2"></div>
        
            <div class="col-md-12">
                <div class="card card-default card-profile">

                    <!-- Account Settings -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2 class="mb-5">
                                <a href="{{ route('liste_stock_departement')}}" class="text-dark">Voir stock departement</a>
                            </h2>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Sortie</th>
                                        <th>Article</th>
                                        <th>Quantite</th>
                                        <th>Departement</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeDepart as $depart)
                                    <tr>
                                        <td>
                                            {{$depart->dates}}
                                        </td>
                                        <td>
                                            {{$depart->id}} 
                                        </td>
                                        <td>
                                            {{$depart->article}} : {{$depart->nom_article}}
                                        </td>
                                        <td>
                                            {{$depart->quantite}}
                                        </td>
                                        <td>
                                            {{$depart->type}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

</div>
@endsection