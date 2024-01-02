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
                            <h2>
                                <a href="{{ route('histporique_liste')}}" class="text-dark">Historique mouvement</a>/  
                                <a href="{{ route('liste_entre')}}" class="text-danger" >Stock actuelle</a>/ 
                                <a href="{{ route('recherche_stock')}}" class="text-danger" >Recherche stock</a>
                            </h2>
                        </div>
                        <div class="card-body">
                        <div class="form-group mb-2">
                                <form action="""id="searchForm">
                                    
                                    <h4 class="text-primary"> Recherche de stock :</h4>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="firstName">Date debut:</label>
                                                <input type="date" class="form-control" id="startDate" name="date">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="firstName">Date fin:</label>
                                                <input type="date" class="form-control" id="endDate" name="datefin">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="lastName">Artice:</label>
                                                <select name="article" id="article" class="form-control">
                                                    @foreach($listeArticle as $article)
                                                        <option value="{{ $article->id }}">{{ $article->article }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-4">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">Chercher</button>
                                        </div> -->
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
                                        <th>Departement</th>
                                        <th>Reception</th>
                                    </tr>
                                </thead>
                                <tbody id="line-container-age">
                                    @foreach($listeEntre as $entre)
                                    <tr>
                                        <td>
                                            {{$entre->dates}}
                                        </td>
                                        <td>
                                            {{$entre->article}}
                                        </td>
                                        <td>
                                            {{$entre->quantite}}
                                        </td>
                                        <td>
                                            {{$entre->id}}
                                        </td>
                                        <td>
                                            {{$entre->type}}
                                        </td>
                                        <td>
                                            {{$entre->reception}}
                                        </td>
                                        
                                    </tr>
                                    @endforeach
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


