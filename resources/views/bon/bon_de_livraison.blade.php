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

                                    <span><strong>Entreprise : </strong></span>
                                    <span><strong>Téléphone : </strong></span>
                                    <span><strong>Email : </strong></span>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <span><strong>Bon de livraison n° : </strong></span>
                                    <span><strong>Date : </strong> {{ $date }}</span>
                                    <span><strong>Lieu : </strong> {{ $lieu }} </span>
                                    <span><strong>N° de commande : </strong> {{ $numero }}</span>
                                    <span><strong>Numéro du client : </strong></span>
                                    <span><strong>Contact du client : </strong></span>
                                    <span><strong>Emis par : </strong> {{ $livreur }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span><strong>Destinataire : </strong></span>
                                    <span><strong>Fonction : </strong></span>
                                    <span><strong>Nom : </strong></span>
                                    <span><strong>Adresse : </strong></span>
                                </div>
                                
                            </div>

                            <br><br>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-secondary text-capitalize">Informations additionnelles : </h5>
                                    <p>{{ $information }}</p>
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
                                                <th scope="col">Unité</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">1</td>
                                                <td>Lucia</td>
                                                <td>Christ</td>
                                                <td>@Lucia</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">2</td>
                                                <td>Catrin</td>
                                                <td>Seidl</td>
                                                <td>@catrin</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">5</td>
                                                <td>Ursel</td>
                                                <td>Harms</td>
                                                <td>@ursel</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">6</td>
                                                <td>Anke</td>
                                                <td>Sauter</td>
                                                <td>@Anke</td>
                                            </tr>
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