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
                                <a href="{{ route('liste_vente')}}" class="text-dark">Liste des vente</a>/  
                                <a href="{{ route('recherche_vente')}}" class="text-danger" >Recherche de vente</a>
                            </h2>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Article</th>
                                        <th>Quantite</th>
                                        <th>Nom Produits</th>
                                        <th>Lieu</th>
                                        <th>Numero Caisse</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeVente as $vente)
                                    <tr>
                                        <td>
                                            {{$vente->dates}}
                                        </td>
                                        <td>
                                            {{$vente->article}}
                                        </td>
                                        <td>
                                            {{$vente->quantite}}
                                        </td>
                                        <td>
                                            {{$vente->nom_article}}
                                        </td>
                                        <td>
                                            {{$vente->lieu_vente}}
                                        </td>
                                        <td>
                                            {{$vente->numero_caisse}}
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