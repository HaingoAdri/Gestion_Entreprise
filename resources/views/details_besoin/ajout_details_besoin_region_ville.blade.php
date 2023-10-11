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
                        <h2>Besoin Region Ville</h2>
                    </div>
                <div class="card-body">
                    <div class="collapse" id="collapse-horizontal-validation"></div>

                        <form action="{{ route('insertion_Details_Region_Ville') }}">
                            <div class="form-group row mb-4">
                                <div class="col-xl-6">
                                    <label for="coverImage" class="col-sm-4 col-form-label">Region</label>
                                    <select name="region" class="form-control" onchange="ajoutVille()">
                                        @foreach($listeRegions as $region)
                                            <option value="{{ $region->id }}">{{ $region->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6">
                                    <label for="coverImage" class="col-sm-4 col-form-label">Note</label>
                                    <input type="number" class="form-control" id="noteRegion" name="noteRegion" placeholder="Note">
                                </div>
                            </div>

                            <div class="form-group row mb-4" id="forVille" style="display: none;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ville</th>
                                            <th>Note ville</th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-ville">
                                        <tr id="tbody-ville">
                                            <td id="ville">
                                                <select name="ville[]" class="form-control" id="villeSelect">
                                                </select>
                                            </td>
                                            <td><input type="number" class="form-control" id="noteVille[]" name="noteVille[]" placeholder="Note"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal" id="ajout">Ajouter ligne</button>
                            <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal" id="supprimer">Supprimer ligne</button>
                            
                            <button class="btn btn-primary btn-pill mr-2" type="submit">Submit</button>
                            <a href="{{ route('ajout_details_besoin_experience') }}"><button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">suivant</button></a>
                            
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
        ajoutDeLigneVille();
    });

    document.querySelector("#supprimer").addEventListener("click", () => {
        deleteLigneVille();
    });

    function ajoutDeLigneVille() {
        var container = document.getElementById("line-container-ville");
        var lines = document.querySelectorAll("#tbody-ville");
        var newLine = lines[lines.length - 1].cloneNode(true);

        container.appendChild(newLine);
    }

   function deleteLigneVille(){
       document.getElementById("line-container-ville").deleteRow(1);
   }

   function ajoutVille() {
        var regionSelect = document.querySelector('select[name="region"]');
        var selectedRegion = regionSelect.value;
        console.log("Selected Region: " + selectedRegion);

        if (selectedRegion !== "") {
            // Show the "Ville" dropdown div
            var villeDiv = document.getElementById("forVille");
            villeDiv.style.display = "block";
  
            // Get the "Ville" select element
            var villeSelect = document.getElementById("villeSelect");

            // Clear existing options
            villeSelect.innerHTML = "";

            // Fetch the Ville data based on the selected region using AJAX
            recupData(selectedRegion, function (response) {
                if (response.error) {
                    console.error(response.error);
                } else {
                    // Populate the "Ville" select dropdown with the received data
                    // Check if response is an array
                    if (Array.isArray(response.data)) {
                        // Iterate over the array
                        response.data.forEach(function (ville) {
                            var option = document.createElement("option");
                            option.value = ville.id;
                            option.textContent = ville.type;
                            villeSelect.appendChild(option);
                        });
                    } else {
                        console.error("Response is not an array:", response);
                    }

                }
            });
        }
    }

    function recupData(idRegion, callback) {
        const request = new XMLHttpRequest();
        const url = `http://127.0.0.1:8000/send-ville/${idRegion}`;
        request.open("GET", url, true);

        request.onload = function () {
            if (request.status === 200) {
                const response = JSON.parse(request.responseText);
                callback(response);
            } else {
                console.error("Error: " + request.status);
            }
        };

        request.onerror = function () {
            console.error("Request failed");
        };

        request.send();
    }

</script>

@endsection
