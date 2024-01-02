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
                                <a href="{{ route('sortie_stock')}}" class="text-dark"> Faire sortie de stock</a>/
                                <a href="{{ route('liste_sortie_stock')}}" class="text-danger"> Voir liste sortie de stock</a>
                            </h2>
                        </div>

                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-primary">
                                    <strong>Erreur:</strong> {{ session('error') }}
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success">
                                    <strong>Reponse:</strong> {{ session('success') }}
                                </div>
                            @endif
                            <form action="inserer_Sortie" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="userName">Date</label>
                                    <input type="date" class="form-control" id="numero" name="dates">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Article</label>
                                    <select name="article" id="" class="form-control">
                                        @foreach($listeArticle as $article)
                                            <option value="{{ $article->id }}">{{ $article->article }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Quantite</label>
                                    <input type="number" class="form-control" id="numero" name="quantite">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Types de sortie :</label>
                                    <select name="sortie_type" id="" class="form-control">
                                        @foreach($listeType as $type)
                                            <option value="{{ $type->id }}">{{ $type->types}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Lieu de vente (si types de sortie vente)</label>
                                    <input type="number="text" class="form-control" id="numero" name="lieu">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">N° de caisse (si types de sortie vente)</label>
                                    <input type="text" class="form-control" id="numero" name="numero">
                                </div>

                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Inserer sortie</button>
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