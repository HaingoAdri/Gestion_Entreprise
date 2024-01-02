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
                                <a href="{{ route('entre_manuelle')}}" class="text-dark">Faire une entre manuelle</a>/  
                                <a href="{{ route('entre_checkBox')}}" class="text-danger" >Entre à partir des reception</a>
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
                            <form action="insert_entre_manuelle" method="POST">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Date</label>
                                            <input type="date" class="form-control" id="date" name="date">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Reception</label>
                                            <select name="reception" id="" class="form-control">
                                                @foreach($listebonReception as $reception)
                                                    <option value="{{ $reception->id }}">{{ $reception->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Article</label>
                                            <select name="article" id="" class="form-control">
                                                @foreach($listeArticle as $article)
                                                    <option value="{{ $article->id }}">{{ $article->article }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Quantite</label>
                                            <input type="number" class="form-control" id="lieu" name="quantite">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="userName">Prix unitaire</label>
                                    <input type="number" class="form-control" id="numero" name="prix">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Departement</label>
                                    <select name="depart" id="" class="form-control">
                                        @foreach($listeModule as $module)
                                            <option value="{{ $module->id }}">{{ $module->type }}</option>
                                        @endforeach
                                    </select>
                                </div>

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