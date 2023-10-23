@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content"><!-- For Components documentaion -->
        
    <h2>Inserer Question aux qcm:</h2>
        <div class="row">
           
                           
                        
            <div class="col-xl-6">
            @foreach($listeQcm as $poste)
                <!-- Horizontal Validation -->
                <div class="card card-default">
                        
                        <div class="card-body">
                            <div class="collapse" id="collapse-horizontal-validation"></div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Qcm</th>
                                            <th>Description</th>
                                            <th>Bouton</th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-experience">
                                       
                                            <tr id="tbody-experience">
                                                <td><p>{{ $poste-> titre }}</p></td>
                                                <td><p>{{ $poste-> description }}</p></td>
                                                <td><button type="button" class="btn btn-primary" id = "ll" data-toggle="modal" data-target="#liste{{ $poste->idqcm }}">Inserer Question</button></td>
                                            </tr>
                                        
                                    </tbody>
                                </table>
                        </div>
                </div>
                <div class="modal fade" id="liste{{ $poste->idqcm }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                        aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    
                                        <div class="modal-header px-4">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter Reponse aux {{ $poste->titre}}:</h5>
                                        </div>
                                        <div class="modal-body px-4">

                                            <form action="{{ route('inserer_Question') }}">
                                            @csrf
                                                <div class="form-group row mb-4">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Inserer Question pour Qcm</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody id="line-container-age">
                                                            <tr id="tbody-age">
                                                                <td><input type="text" class="form-control" id="questions" name="questions" placeholder="question"></td>
                                                                <td><input type="number" class="form-control" id="annonce" name="annonce" value="{{ $poste->idqcm}}" hidden><td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal" id="ajout">Ajouter nouvelle ligne</button>
                                                <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal" id="supprimer">Supprimer ligne</button>
                                                <a class="btn btn-smoke btn-pill" href=" {{ route('inserer_reponse', ['idqcm'=>$poste->idqcm ] ) }} " >Voir questions </a>
                                                <button class="btn btn-primary btn-pill mr-2" type="submit">Submit</button>
                                            </form>

                                        </div>
                                
                                </div>
                            </div>
                </div>
                        


                @endforeach
        </div>

    </div>
          
</div>

<script defer>
   
   document.querySelector("#ajout").addEventListener("click", () => {
        ajoutDeLigneAge();
    });

    document.querySelector("#supprimer").addEventListener("click", () => {
        deleteLigneAge();
    });

    function ajoutDeLigneAge() {
        var container = document.getElementById("line-container-age");
        var lines = document.querySelectorAll("#tbody-age");
        var newLine = lines[lines.length - 1].cloneNode(true);

        var qeust = lines[lines.length - 1].querySelector("input[name='questions[]']");
        var questionsInput = newLine.querySelector("input[name='questions[]']");
        questionsInput.value ="";

        var annonceInput = newLine.querySelector("input[name='annonce[]']");
      

        container.appendChild(newLine);
    }

   function deleteLigneAge(){
       document.getElementById("line-container-age").deleteRow(1);
   }

</script>
@endsection
