@extends("template.header")

@section("contenu")
<!-- ====================================
——— CONTENT WRAPPER
===================================== -->
<div class="content-wrapper">
    <div class="content"><!-- For Components documentaion -->
        <div class="card card-default">
            <div class="px-6 py-4">
                <p>Mono provides a variety of <span class="text-secondary text-capitalize"> Bootstrap Forms Validation </span> components with a
                little customization that suits its design standards. For more information, please see the official <a class="font-weight-bold" href="https://getbootstrap.com/docs/4.3/components/forms/#validation" target="_blank"> Bootstrap documentation.</a></p>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <!-- Horizontal Validation -->
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Besoin Diplome</h2>
                    </div>
                <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>

                        <form action="{{ route('insertion_Details_Diplome') }}">
                            <div class="form-group row mb-4">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Diplome</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-diplome">
                                        <tr id="tbody-diplome">
                                            <td>
                                                <select name="diplome[]" class="form-control">
                                                    @foreach($listeDiplomes as $diplome)
                                                        <option value="{{ $diplome->id }}">{{ $diplome->type }}</option>
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
                            <button class="btn btn-light btn-pill" type="submit">Cancel</button>
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
        ajoutDeLigneDiplome();
    });

    document.querySelector("#supprimer").addEventListener("click", () => {
        deleteLigneDiplome();
    });

    function ajoutDeLigneDiplome() {
        var container = document.getElementById("line-container-diplome");
        var lines = document.querySelectorAll("#tbody-diplome");
        var newLine = lines[lines.length - 1].cloneNode(true);

        container.appendChild(newLine);
    }

   function deleteLigneDiplome(){
       document.getElementById("line-container-diplome").deleteRow(1);
   }

</script>

@endsection
