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
                            <h2 class="mb-5">Création du proces verbal de récéption</h2>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('create_pv_de_reception_form') }}">
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Date</label>
                                            <input type="date" class="form-control" id="date" name="date">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Lieu</label>
                                            <select name="lieu" class="form-control">
                                                @if(count($listeLieu) > 0)
                                                    @foreach($listeLieu as $lieu)
                                                        <option value="{{ $lieu->id }}">{{ $lieu->nom }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Listes des immobilisations</label>
                                    <select name="compte" class="form-control">
                                        @if(count($listeCompte) > 0)
                                            @foreach($listeCompte as $compte)
                                                <option value="{{ $compte->id }}">{{ $compte->nom }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Etat</label>
                                    <select name="etat" class="form-control">
                                        @if(count($etats) > 0)
                                            @foreach($etats as $etat)
                                                <option value="{{ $etat->id }}">{{ $etat->nom }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Livreur</label>
                                    <select name="livreur" class="form-control">
                                        @if(count($listeLivreur) > 0)
                                            @foreach($listeLivreur as $livreur)
                                                <option value="{{ $livreur->id }}">{{ $livreur->nom }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Créer</button>
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