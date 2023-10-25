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
                        <h2>Besoin Age</h2>
                    </div>
                <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>

                        <form action="{{ route('insertion_Details_Age') }}">
                            <div class="form-group row mb-4">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Age minimum</th>
                                            <th>Age maximum</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-age">
                                        <tr id="tbody-age">
                                            <td><input type="number" class="form-control" id="minAge[]" name="minAge[]" placeholder="Age minimum"></td>
                                            <td><input type="number" class="form-control" id="maxAge[]" name="maxAge[]" placeholder="Age maximum"></td>
                                            <td><input type="number" class="form-control" id="noteAge[]" name="noteAge[]" placeholder="Note"></td>
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
        ajoutDeLigneAge();
    });

    document.querySelector("#supprimer").addEventListener("click", () => {
        deleteLigneAge();
    });

    function ajoutDeLigneAge() {
        var container = document.getElementById("line-container-age");
        var lines = document.querySelectorAll("#tbody-age");
        var newLine = lines[lines.length - 1].cloneNode(true);

        var prevMaxAgeInput = lines[lines.length - 1].querySelector("input[name='maxAge[]']");
        var minAgeInput = newLine.querySelector("input[name='minAge[]']");
        minAgeInput.value = prevMaxAgeInput.value;

        var maxAgeInput = newLine.querySelector("input[name='maxAge[]']");
        var noteInput = newLine.querySelector("input[name='noteAge[]']");
        maxAgeInput.value = "";
        noteInput.value = "";

        container.appendChild(newLine);
    }

   function deleteLigneAge(){
       document.getElementById("line-container-age").deleteRow(1);
   }

</script>

@endsection
