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
                                <a href="{{ route('histporique_liste')}}" class="text-dark">Historique mouvement</a>/  
                                <a href="{{ route('liste_entre')}}" class="text-danger" >Stock actuelle</a>/ 
                                <a href="{{ route('recherche_stock')}}" class="text-danger" >Recherche stock</a>
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
                                        <!-- <th>Departement</th> -->
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeHistorique as $histo)
                                    <tr>
                                        <td>
                                            {{$histo->dates}}
                                        </td>
                                        <td>
                                            {{$histo->article}}
                                        </td>
                                        <td>
                                            {{$histo->quantite}}
                                        </td>
                                        <td>
                                            {{$histo->entre}}
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