@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Annonce</h2>
            </div>

            <div class="card-body px-3 px-md-5">
                <div class="row">
                    <div class="col-lg-6 col-xl-4">
                        <div class="card card-default p-4">
                        <a href="javascript:0" class="media text-secondary" data-toggle="modal" data-target="#modal-contact">
                            <img src="assets/images/user/u-xl-1.jpg" class="mr-3 img-fluid rounded" alt="Avatar Image">
            
                            <div class="media-body">
                                <h5 class="mt-0 mb-2 text-dark">Emma Smith</h5>
                                <ul class="list-unstyled text-smoke text-smoke">
                                    <li class="d-flex">
                                        <i class="mdi mdi-map mr-1"></i>
                                        <span>Nulla vel metus 15/178</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="mdi mdi-email mr-1"></i>
                                        <span>exmaple@email.com</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="mdi mdi-phone mr-1"></i>
                                        <span>(123) 888 777 632</span>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
  
            </div>

            <div class="card-header align-items-center px-3 px-md-5">
                <h2></h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Postuler
                </button>
            </div>
        </div>
    </div>


    <!-- Contact Modal -->
    <div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-end border-bottom-0">
                    <button type="button" class="btn-edit-icon" data-dismiss="modal" aria-label="Close">
                        <i class="mdi mdi-pencil"></i>
                    </button>
                    
                    <div class="dropdown">
                        <button class="btn-dots-icon" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </button>
					
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    
                    <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Add Contact Button  -->
    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form >
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Quels sont les criteres ?</h5>
                    </div>
                    <div class="modal-body px-4">

                    <div class="row mb-2">
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="lastName">Nationalite</label>
                            <select name="nationalite" class="form-control" required>
                                <option value="">Nationalite</option>
                                @foreach($listeNationalites as $nationalite)
                                    <option value="{{ $nationalite->id }}">{{ $nationalite->type }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                            <label for="email">Diplome</label>
                            <select name="diplome" class="form-control" required>
                                <option value="">Diplome</option>
                                @foreach($listeDiplomes as $diplome)
                                    <option value="{{ $diplome->id }}">{{ $diplome->type }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <label for="coverImage" class="col-sm-4 col-form-label">Region</label>
                            <select name="region" class="form-control" onchange="ajoutVille()" required>
                                <option value="">Region</option>
                                @foreach($listeRegions as $region)
                                    <option value="{{ $region->id }}">{{ $region->type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                            <label for="event">Experience minimum</label>
                            <input type="text" class="form-control" id="experience" name="experience" required>
                            </div>
                        </div>

                        <div class="col-xl-6" id="forVille" style="display: none;">  
                            <label for="coverImage" class="col-sm-4 col-form-label">Ville</label>
                            <select name="ville" class="form-control" id="villeSelect">
                                <option value="">Ville</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="event">Salaire</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <input type="text" class="form-control" id="" name="salaire_min" placeholder=" Salaire Min" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <input type="text" class="form-control" id="" name="salaire_max" placeholder="Salaire Max" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="lastName">Situation matrimoniale</label>
                            <select name="situation" class="form-control" required>
                                <option value="">Situation</option>
                                @foreach($listeSituations as $situation)
                                <option value="{{ $situation->id }}">{{ $situation->type }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <button type="button" class="btn btn-primary">Import Diplome</button>
                            <button type="button" class="btn btn-secondary">Import Atestation Travail Anterieur</button>
                        </div>

                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                    <br>
                    <button type="submit" class="btn btn-primary btn-pill">Suivant</button>
                </div>
    
            </form>
            </div>
        </div>
    </div>

</div>


<script defer>
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