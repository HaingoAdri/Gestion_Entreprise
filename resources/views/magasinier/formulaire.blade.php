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
                                    <h3 class="font-weight-bold">Faire sortie de stock / 
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact">Liste des sorties finient </button></h3>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            
                            <form  method="POST" action="{{ route('input_sortie') }}">
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
                                            <label for="lastName">Produits</label>
                                            <select name="produits"  class="form-control">
                                                @foreach($listeArticle as $article)
                                                <option value="{{ $article->article }}">{{ $article->article }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Quantite</label>
                                            <input type="nulber" class="form-control" name="quantite">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastName">Type de sortie</label>
                                            <select name="sortie"  class="form-control">
                                                @foreach($types as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-6">
                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Faire sortie</button>
                                </div>
                            </form>
                        </div>
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

                        <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                        aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <h5 class="text-secondary text-capitalize"><u>Liste de tous les sorties: </u></h5>

                                                <br>
                                                
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                        <!-- <th scope="col">#</th> -->
                                                            <th scope="col">Dates</th>
                                                            <th scope="col">Produits</th>
                                                            <th scope="col">Etats</th>
                                                            <th scope="col">Entre</th>
                                                            <th scope="col">Quantite</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                        @foreach($allSorties as $sortie)  
                                                            <tr>
                                                                <td>{{$sortie->dates}}</td>
                                                                <td>{{$sortie->produits}}</td>
                                                                <td>{{$sortie->etats}}</td>
                                                                <td>{{$sortie->entre}}</td>
                                                                <td>{{$sortie->quantite}}</td>
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

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection