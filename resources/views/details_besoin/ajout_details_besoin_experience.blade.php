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
                        <h2>Besoin Experience</h2>
                    </div>
                <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>

                        <form action="{{ route('insertion_Details_Experience') }}">
                            <div class="form-group row mb-4">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Annee d'experience</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-experience">
                                        <tr id="tbody-experience">
                                            <td><input type="number" class="form-control" id="anneeExperience[]" name="anneeExperience[]" placeholder="Annee d'experience"></td>
                                            <td><input type="number" class="form-control" id="note[]" name="note[]" placeholder="Note"></td>
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
        ajoutDeLigne();
    });

    document.querySelector("#supprimer").addEventListener("click", () => {
        deleteLigne();
    });

    function ajoutDeLigne() {
        var container = document.getElementById("line-container-experience");
        var lines = document.querySelectorAll("#tbody-experience");
        var newLine = lines[lines.length - 1].cloneNode(true);

        var Input = newLine.querySelector("input[name='anneeExperience[]']");
        var noteInput = newLine.querySelector("input[name='note[]']");
        Input.value = "";
        noteInput.value = "";

        container.appendChild(newLine);
    }

   function deleteLigne(){
       document.getElementById("line-container-experience").deleteRow(1);
   }

</script>

@endsection
