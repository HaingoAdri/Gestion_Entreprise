@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    
    <div class="content">
        <div class="row">
            <div class="col-md-2"></div>
        
            <div class="col-md-8">
                <div class="card card-default card-profile">

                    <!-- Account Settings -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2 class="mb-5">
                                <a href="" class="text-dark"> Faire Inventaire</a> / <a href="{{ route('liste_inventaire') }}" class="text-dark"> Liste Inventaire</a>   
                            </h2>
                        </div>

                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="post" action="{{ route('insert_inventaire') }}">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="userName">Date</label>
                                    <input type="date" class="form-control" name="dates" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Immobilisation récéptionner :</label>
                                    <select name="immobilisation" id="" class="form-control" required>
                                        @foreach($listeImmo as $pv)
                                        <option value="{{ $pv->id_immobilisation }}">
                                            {{ $pv->id_immobilisation }}
                                        </option>
                                        @endforeach 
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Etat immobilisation :</label>
                                    <select name="etat" id="" class="form-control" required>
                                        @foreach($listeEtats as $et)
                                        <option value="{{ $et->id}}">
                                            {{ $et->nom }}
                                        </option>
                                        @endforeach 
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Taux</label>
                                    <input type="number" class="form-control" name="taux" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Ammortissement :</label>
                                    <select name="ammortissement" id="" class="form-control" required>
                                        @foreach($listeAmmortissement as $e)
                                        <option value="{{ $e->id}}">
                                            {{ $e->nom }}
                                        </option>
                                        @endforeach 
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Type d'inventaire</label>
                                    <input type="text" class="form-control" name="type"  placeholder="Genre de pv" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Libelle</label>
                                    <input type="text" class="form-control" name="libele" placeholder="Cause de l'inventaire" required>
                                </div>
                                

                                <div class="form-group mb-4">
                                    <label for="userName">Description</label>
                                    <input type="text" class="form-control" name="description" required>
                                </div>

                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2">Inserer inventaire</button>
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