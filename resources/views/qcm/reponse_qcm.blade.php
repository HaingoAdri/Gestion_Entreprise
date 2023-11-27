@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content"><!-- For Components documentaion -->
        
        <h2>Inserer Reponse aux Question:</h2>
        <div class="row">
        @foreach($quest as $question)
            <div class="col-xl-6">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                
                        
                        <div class="card-body">
                            <div class="collapse" id="collapse-horizontal-validation"></div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Ajouter Reponse</th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-experience">
                                        
                                            <tr id="tbody-experience">
                                                <td><p>{{ $question->questions }}</p></td>
                                                <td><button type="button" class="btn btn-primary" id = "ll" data-toggle="modal" data-target="#liste{{ $question->id_q }}">Inserer Reponse</button></td>
                                            </tr>
                                        
                                    </tbody>
                                </table>
                        </div>
                      
                </div>
                <div class="modal fade" id="liste{{ $question->id_q}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                        aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    
                                        <div class="modal-header px-4">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter Reponse aux {{ $question->questions }}:</h5>
                                        </div>
                                        <div class="modal-body px-4">

                                            <form action="{{ route('mampiditraValiny') }}">
                                            @csrf
                                                <div class="form-group row mb-4">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Inserer Reponse Vrai</th>
                                                                <th>Inserer Reponse Faux</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="line-container-age">
                                                            <tr id="tbody-age">
                                                                <td><input type="text" class="form-control" id="reponseVrai" name="reponseVrai" placeholder="Reponse vrai"></td>
                                                                <td><input type="text" class="form-control" id="reponseFaux" name="reponseFaux" placeholder="Reponse Faux"></td>
                                                                <td><input type="number" class="form-control" id="annonce" name="annonce" value="{{ $question->id_q}}" hidden><td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                 <button class="btn btn-primary btn-pill mr-2" type="submit">Submit</button>
                                                 <a class="btn btn-smoke btn-pill" href=" {{ route('reponse', ['idQ'=>$question->id_q ] ) }} " >Listes Reponses </a>
                                            </form>
                                        </div>
                                        
                                </div>
                            </div>
                </div>
                
        </div>
        @endforeach
    </div>
          
</div>
@endsection
