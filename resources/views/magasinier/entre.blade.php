@ -0,0 +1,71 @@
@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content"><!-- Card Profile -->
        <div class="row">
            <div class="col-md-2"></div>
        
            <div class="col-md-8">
                <div class="card card-default card-profile">

                    <div class="card card-default">
                        <div class="card-header">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="font-weight-bold">Liste d'entre de stock</h3>

                                    <br>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <h5 class="text-secondary text-capitalize"><u>Détails : </u></h5>

                                    <br>
                                    
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                                <th scope="col">Dates</th>
                                                <th scope="col">Entre</th>
                                                <th scope="col">Produits</th>
                                                <th scope="col">Quantite</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            @foreach($listeEntre as $entre)  
                                                <tr>
                                                    <td>{{$entre->ide}}</td>
                                                    <td>{{$entre->date}}</td>
                                                    <td>{{$entre->commande}}</td>
                                                    <td>{{$entre->article}}</td>
                                                    <td>{{$entre->quantite}}</td>
                                                </tr>  
                                            @endforeach  
                                        </tbody>
                                    </table>  
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

</div>
@endsection