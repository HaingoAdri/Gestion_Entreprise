@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Besoin Salaire</h2>
                    </div>
                <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>

                        <form action="{{ route('insertion_Details_Salaire') }}">
                            <div class="form-group row mb-4">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Salaire minimum</th>
                                            <th>Salaire maximum</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-salaire">
                                        <tr id="tbody-salaire">
                                            <td><input type="number" class="form-control" id="minSalaire[]" name="minSalaire[]" placeholder="Salaire minimum"></td>
                                            <td><input type="number" class="form-control" id="maxSalaire[]" name="maxSalaire[]" placeholder="Salaire maximum"></td>
                                            <td><input type="number" class="form-control" id="noteSalaire[]" name="noteSalaire[]" placeholder="Note"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal" id="ajout">Ajouter nouvelle ligne</button>
                            <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal" id="supprimer">Supprimer ligne</button>

                            <button class="btn btn-primary btn-pill mr-2" type="submit">Submit</button>
                        </form>

                    </div>
                </div>

            </div>
            <div class="col-xl-3"></div>
        </div>

    </div>
          
</div>


<script defer>
   
   document.querySelector("#ajout").addEventListener("click", () => {
        ajoutDeLigneSalaire();
    });

    document.querySelector("#supprimer").addEventListener("click", () => {
        deleteLigneSalaire();
    });

    function ajoutDeLigneSalaire() {
        var container = document.getElementById("line-container-salaire");
        var lines = document.querySelectorAll("#tbody-salaire");
        var newLine = lines[lines.length - 1].cloneNode(true);

        var prevMaxSalaireInput = lines[lines.length - 1].querySelector("input[name='maxSalaire[]']");
        var minSalaireInput = newLine.querySelector("input[name='minSalaire[]']");
        minSalaireInput.value = prevMaxSalaireInput.value;

        var maxSalaireInput = newLine.querySelector("input[name='maxSalaire[]']");
        var noteInput = newLine.querySelector("input[name='noteSalaire[]']");
        maxSalaireInput.value = "";
        noteInput.value = "";

        container.appendChild(newLine);
    }

   function deleteLigneAge(){
       document.getElementById("line-container-salaire").deleteRow(1);
   }

</script>

@endsection
