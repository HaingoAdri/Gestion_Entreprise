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
                        <h2>Besoin Genre et Situation matrimoniale</h2>
                    </div>
                <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>

                        <form action="{{ route('insertion_Details_Genre_Matrimoniale') }}">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="custom-control custom-checkbox checkbox-info d-inline-block mr-3 mb-3">
                                            <input type="checkbox" class="custom-control-input" id="customCheckInfo"checked="checked" name="hommeCheckbox">
                                            <label class="custom-control-label" for="customCheckInfo">Homme</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="number" class="form-control" id="noteMasculin" name="noteMasculin" placeholder="Note">
                                    </div>
                                </div>
                                </br>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="custom-control custom-checkbox checkbox-secondary d-inline-block mr-3 mb-3">
                                            <input type="checkbox" class="custom-control-input" id="customCheckSecondary" checked="checked" name="femmeCheckbox">
                                            <label class="custom-control-label" for="customCheckSecondary">Femme</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="number" class="form-control" id="noteFeminin" name="noteFeminin" placeholder="Note">
                                    </div>
                                </div>
                            </br>
                            <div class="form-group row mb-4">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Situation Matrimoniale</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-situation">
                                        <tr id="tbody-situation">
                                            <td>
                                                <select name="situation[]" class="form-control">
                                                    @foreach($listeSituations as $situation)
                                                    <option value="{{ $situation->id }}">{{ $situation->type }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" class="form-control" id="note[]" name="note[]" placeholder="Note"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal" id="ajout">Ajouter nouvelle ligne</button>
                            <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal" id="supprimer">Supprimer ligne</button>

                            <button class="btn btn-primary btn-pill mr-2" type="submit">Submit</button>
                            <button class="btn btn-light btn-pill" type="button">Cancel</button>
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
        ajoutDeLigneSituation();
    });

    document.querySelector("#supprimer").addEventListener("click", () => {
        deleteLigneSituation();
    });

    function ajoutDeLigneSituation() {
        var container = document.getElementById("line-container-situation");
        var lines = document.querySelectorAll("#tbody-situation");
        var newLine = lines[lines.length - 1].cloneNode(true);

        var noteInput = newLine.querySelector("input[name='note[]']");
        noteInput.value = "";

        container.appendChild(newLine);
    }

   function deleteLigneSituation(){
       document.getElementById("line-container-situation").deleteRow(1);
   }

</script>
@endsection
