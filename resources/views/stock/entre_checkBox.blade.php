@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    
    <div class="content">
        <div class="row">
            <div class="col-md-2"></div>
        
            <div class="col-md-12">
                <div class="card card-default card-profile">
                    @if(session('error'))
                        <div class="alert alert-primary">
                            <strong>Erreur:</strong> {{ session('error') }}
                        </div>
                    @endif
                    <!-- Account Settings -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2 class="mb-5">
                                <a href="{{ route('entre_manuelle')}}" class="text-dark">Faire une entre manuelle</a>
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
                                        <th>Demande</th>
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
                                    <?php $count = 0; ?>
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
                                            {{ $entre->demande }}
                                            <input type="hidden" name="demande[]" value="{{ $entre->demande }}">
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
                                        <td><input type="checkbox" name="valider[]" value="<?php echo $count; ?>" class="form-check-input"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#liste{{ $entre->article }}"> 
                                                X
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                    
            
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mt-6">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill">Inserer entre</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
           
            
        </div>
    </div>

</div>
@endsection