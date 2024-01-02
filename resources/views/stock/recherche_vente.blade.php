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
                                <a href="{{ route('liste_vente')}}" class="text-dark">Liste des vente</a>/  
                                <a href="{{ route('recherche_vente')}}" class="text-danger" >Recherche de vente</a>
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <form action="">
                                    <h4 class="text-primary"> Recherche de vente :</h4>
                                    <div class="row">
                                        
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="firstName">Date :</label>
                                                <input type="date" class="form-control" id="date" name="date">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="lastName">Artice:</label>
                                                <select name="" id="" class="form-control">
                                                    @foreach($listeArticle as $article)
                                                        <option value="{{ $article->id }}">{{ $article->article }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">Chercher</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Article</th>
                                        <th>Quantite</th>
                                        <th>Entre</th>
                                        <th>Lieu</th>
                                        <th>Departement</th>
                                        <th>Prix TTC</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    <td>
                                        ...
                                    </td>
                                    <td>
                                        ...
                                    </td>
                                    <td>
                                        ...
                                    </td>
                                    <td>
                                        ...
                                    </td>
                                    <td>
                                        ...
                                    </td>
                                    <td>
                                        ...
                                    </td>
                                    <td>
                                        ...
                                    </td>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

</div>
@endsection