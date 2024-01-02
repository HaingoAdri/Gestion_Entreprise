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
                                <a href="{{ route('entre_manuelle')}}" class="text-dark">Faire une entre manuelle</a>/  
                                <a href="{{ route('entre_checkBox')}}" class="text-danger" >Entre à partir des reception</a>
                            </h2>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('inserer_entre_check') }}" method="POST">
                            @csrf   
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Reception</th>
                                        <th>Dates</th>
                                        <th>Article</th>
                                        <th>Quantite</th>
                                        <th>Prix Unitaire</th>
                                        <th>Nom_Departement</th>
                                        <th>Departement indentifiant</th>
                                        <th>Checker</th>
                                        <th>Explication</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeEntre as $entre)
                                    <tr>
                                        <td>
                                            {{ $entre->id }}
                                            <input type="hidden" name="id[]" value="{{ $entre->id }}">
                                        </td>
                                        <td>
                                            {{ $entre->dates }}
                                            <input type="hidden" name="dates[]" value="{{ $entre->dates }}">
                                        </td>
                                        <td>
                                            {{ $entre->article }}
                                            <input type="hidden" name="article[]" value="{{ $entre->article }}">
                                        </td>
                                        <td>
                                            {{ $entre->quantite }}
                                            <input type="hidden" name="quantite[]" value="{{ $entre->quantite }}">
                                        </td>
                                        <td>
                                            {{ $entre->prix_unitaire }}
                                            <input type="hidden" name="prix_unitaire[]" value="{{ $entre->prix_unitaire }}">
                                        </td>
                                        <td>
                                            {{ $entre->reception }}
                                        </td>
                                        <td>
                                            {{ $entre->module }}
                                            <input type="hidden" name="module[]" value="{{ $entre->module }}">
                                        </td>
                                        <td><input type="checkbox" name="valider[]" value="1" class="form-check-input"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#liste{{ $entre->article }}"> 
                                                X
                                            </button>
                                        </td>
                                    </tr>
                                    
            
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mt-6">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill">Inserer entre</button>
                            </div>
                            </form>
                        </div>
                        @foreach($listeEntre as $entre)
                        <div class="modal fade" id="liste{{ $entre->article }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h6 class="mb-5">Demande d'explication pour produits {{ $entre->article }}. </h6>
                                                                    <h6 class="mb-5">Quantite insuffisant {{ $entre->quantite }}. </h6>
                                                                    <form action="">
                                                                        <div class="row mb-2">
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label for="firstName">Date : {{ $entre->dates }}</label>
                                                                                    <input type="hidden" name="dates" value="{{ $entre->dates }}">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label for="lastName">Reception : {{ $entre->id }}</label>
                                                                                    <input type="hidden" name="id" value="{{ $entre->id }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-2">
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label for="firstName">Article : {{ $entre->article }}</label>
                                                                                    <input type="hidden" name="article" value="{{ $entre->article }}">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label for="lastName">Quantite : {{ $entre->quantite }}</label>
                                                                                    <input type="hidden" name="quantite[]" value="{{ $entre->quantite }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group mb-4">
                                                                            <label for="userName">Motif</label>
                                                                            <textarea class="form-control" placeholder="Ecrire motif" name="" required></textarea>
                                                                        </div>

                                                                        <div class="d-flex justify-content-end mt-6">
                                                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">Donner explication</button>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
           
            
        </div>
    </div>

</div>
@endsection