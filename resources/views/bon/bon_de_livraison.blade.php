@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content"><!-- Card Profile -->  
        <div class="row">
            <div class="col-md-2"></div>
        
            <div class="col-md-8">
                <div class="card card-default card-profile">

                    <!-- Account Settings -->
                    <div class="card card-default">
                        <div class="card-header">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="font-weight-bold">Bon de livraison</h3>

                                    <br>

                                    <span><strong>Entreprise : </strong> BOOST</span>
                                    <span><strong>Téléphone : </strong> +261 34 12 345 67 </span>
                                    <span><strong>Email : </strong> service.livraison@boost.mg</span>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <span><strong>Bon de livraison n° : </strong></span>
                                    <span><strong>Date : </strong> {{ $resultat["date"] }}</span>
                                    <span><strong>Lieu : </strong> {{ $resultat["lieu"] }} </span>
                                    <span><strong>N° de commande : </strong> {{ $resultat["numero"] }} </span>
                                    <span><strong>Emis par : </strong> {{ $resultat["livreur"] }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><strong>Destinataire : </strong> MONO </span>
                                    <span><strong>Fonction : </strong> Département Achat</span>
                                    <span><strong>Nom : </strong> {{ Session::get('administrateur_rh')->prenom }} {{ Session::get('administrateur_rh')->nom }} </span>
                                    <span><strong>Adresse : </strong> Akorondrano</span>
                                </div>
                                
                            </div>

                            <br><br>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-secondary text-capitalize">Informations additionnelles : </h5>
                                    <p>{{ $resultat["information"] }}</p>
                                    <p>Merci d'avoir choisis notre entreprise!</p>
                                </div>
                            </div>

                            <br><br>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Désignation</th>
                                                <th scope="col">Quantités</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($details_livraison as $detail)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>{{ $detail->article->article }}</td>
                                                    <td>{{ $detail->nombre }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>  
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-9"></div>
                                <div class="col-md-3">
                                    <a href=""><button class="btn btn-primary mb-2 btn-pill" style="margin-right:2rem"> Exporter PDF </button></a>
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