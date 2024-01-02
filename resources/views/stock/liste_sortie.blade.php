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
                                <a href="{{ route('sortie_stock')}}" class="text-dark"> Faire sortie de stock</a>/
                                <a href="{{ route('liste_sortie_stock')}}" class="text-danger"> Voir liste sortie de stock</a> 
                            </h2>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Article</th>
                                        <th>Quantite</th>
                                        <th>Entre</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeSortie as $sortie)
                                    <tr>
                                        <td>
                                            {{$sortie->dates}}
                                        </td>
                                        <td>
                                            {{$sortie->article}} : {{$sortie->nom}}
                                        </td>
                                        <td>
                                            {{$sortie->quantite}}
                                        </td>
                                        <td>
                                            {{$sortie->entre}}
                                        </td>
                                        <td>
                                            {{$sortie->types}}
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