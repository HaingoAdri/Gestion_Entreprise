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
                                    <h3 class="font-weight-bold">Bon de récéption</h3>

                                    <br>

                                    <span><strong>Fournisseur : </strong></span>
                                    <span><strong>Lieu : </strong> {{ $resultat["lieu"] }} </span>
                                    <span><strong>N° de commande : </strong> {{ $resultat["numero"] }} </span>
                                    <span><strong>Responsable de récéption : </strong> (responsable récéption)</span>
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
                                                <th scope="col">Désignation</th>
                                                <th scope="col">Quantités</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">1</td>
                                                <td>Lucia</td>
                                                <td>Christ</td>
                                                <td>
                                                    <label class="switch switch-primary switch-pill form-control-label ">
                                                        <input type="checkbox" class="switch-input form-check-input" value="on" name="produit">
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">4</td>
                                                <td>Else</td>
                                                <td>Voigt</td>
                                                <td>
                                                    <label class="switch switch-primary switch-pill form-control-label ">
                                                        <input type="checkbox" class="switch-input form-check-input" value="on" name="produit">
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">5</td>
                                                <td>Ursel</td>
                                                <td>Harms</td>
                                                <td>
                                                    <label class="switch switch-primary switch-pill form-control-label ">
                                                        <input type="checkbox" class="switch-input form-check-input" value="on" name="produit">
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>  
                                </div>
                            </div>
                            
                        </div>

                        <div class="card-footer">
                            <p>Edité le : {{ $resultat["date"] }} </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

</div>
@endsection