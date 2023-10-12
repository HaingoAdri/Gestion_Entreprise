@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Annonce</h2>
            </div>
            @if (session('erreur'))
            <div class="alert alert-danger" role="alert">
            <p>{{ session('erreur') }}</p>
            </div>
            @endif

            <div class="card-body px-3 px-md-5">
                <div class="row">
                    @for($i = 0; $i <10; $i++)
                    @foreach($listeBesoins as $besoin)
                    <div class="col-lg-6 col-xl-4">
                        <div class="card card-default p-4" style="border:solid 3px purple;">
                            <a href="javascript:0" class="media text-secondary" data-toggle="modal" data-target="#modal-contact-{{ $besoin->id }}">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-2 text-dark">{{ $besoin->poste->type }}</h5>
                                    <ul class="list-unstyled text-smoke text-smoke">
                                        <li class="d-flex">
                                            <span>Dans le domaine : {{ $besoin->service->type }}.</span>
                                        </li>
                                        <li class="d-flex">
                                            <span>On a besoin de : <strong>{{ $besoin->personnes }}</strong> personnes</span>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Contact Modal -->
                    <div class="modal fade" id="modal-contact-{{ $besoin->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header justify-content-end border-bottom-0"> 
                                    
                                    <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>

                                <div style="margin:2rem;">
                                    <center><h2>{{ $besoin->poste->type }}</h2></center>
                                    <center><p>Dans le domaine : <strong>{{ $besoin->service->type }}</strong></p></center>

                                    <br>
                                    <div class="contact-info px-4">
                                        <p>{{ $besoin->description }} .</p>
                                    </div>
                                    <br>
                                            
                                    <div class="contact-info px-4">
                                        <h4 class="mb-1">Les Criteres</h4>
                                        <p ><span class="text-dark font-weight-medium pt-4 mb-2">Age </span> : entre {{ $besoin->annonce->Age[0] }} et {{ $besoin->annonce->Age[1] }} ans</p>
                                        <p ><span class="text-dark font-weight-medium pt-4 mb-2">Diplome acceptes </span> :
                                            @foreach($besoin->annonce->Diplome as $diplome)
                                                {{ $diplome }},
                                            @endforeach
                                        </p>
                                        <p ><span class="text-dark font-weight-medium pt-4 mb-2">Nationalite acceptes </span> : 
                                            @foreach($besoin->annonce->Nationalite as $nationalite)
                                                {{ $nationalite }},
                                            @endforeach
                                        </p>
                                        <p ><span class="text-dark font-weight-medium pt-4 mb-2">Preference de region </span> : 
                                            @foreach($besoin->annonce->Region as $region)
                                                {{ $region }},
                                            @endforeach
                                        </p>
                                        <p ><span class="text-dark font-weight-medium pt-4 mb-2">Experience besoin</span> : 
                                            @foreach($besoin->annonce->Experience as $experience)
                                                {{ $experience }},
                                            @endforeach
                                            ans
                                        </p>
                                        <p ><span class="text-dark font-weight-medium pt-4 mb-2">Preference pour les situations matrimoniales </span> : 
                                            @foreach($besoin->annonce->Matrimoniale as $matrimoniale)
                                                {{ $matrimoniale }},
                                            @endforeach
                                        </p>
                                    </div>
                                    <!-- <a class="btn btn-primary btn-pill btn-lg my-4" href="">Postuler</a> -->
                                </div>
                                <div class="card-header align-items-center px-3 px-md-5">
                                    <h2></h2>
                    
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact{{ $besoin->id }}"> 
                                        Postuler
                                    </button>
                                </div>
                            </div>
                        </div>
                                
                    </div>

                    <!-- Add Contact Button  -->
                    <div class="modal fade" id="modal-add-contact{{ $besoin->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <form  action="{{ route('ajout_cv') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header px-4">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Completez les criteres suivantes: </h5>
                                    </div>
                                    <div class="modal-body px-4">

                                    <div class="row mb-2">
                                        <input type="text" name="idBesoin" value="{{ $besoin->id }}" hidden>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                            <label for="lastName">Nationalite</label>
                                            <select name="idNationalite" class="form-control" required>
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
                                            <select name="idDiplome" class="form-control" required>
                                                <option value="">Diplome</option>
                                                @foreach($listeDiplomes as $diplome)
                                                    <option value="{{ $diplome->id }}">{{ $diplome->type }}</option>
                                                @endforeach
                                            </select> 
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label for="coverImage" class="col-sm-4 col-form-label">Region</label>
                                            <select name="idRegion" class="form-control" onchange="ajoutVille()" required>
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
                                            <select name="idVille" class="form-control" id="villeSelect">
                                                <option value="">Ville</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="event">Salaire</label>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4">
                                                            <input type="text" class="form-control" id="" name="salaire_min" placeholder="Salaire Min" required>
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
                                            <select name="idSituation" class="form-control" required>
                                                <option value="">Situation</option>
                                                @foreach($listeSituations as $situation)
                                                <option value="{{ $situation->id }}">{{ $situation->type }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="custom-file-upload color-violet">
                                                <input type="file" name="file_diplome" id="file-input" size="20" accept=".pdf" required/>
                                                <i class="mdi mdi-calendar-import"></i> Import Diplome
                                                <div id="file-name-container">
                                                    <p id="file-name"></p>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="custom-file-upload color-pink">
                                                <input type="file" name="file_attestation" id="file-input2" size="20" accept=".pdf"/>
                                                <i class="mdi mdi-calendar-import"></i> Import Attestation Travail Anterieur
                                                <div id="file-name-container2">
                                                    <p id="file-name2"></p>
                                                </div>
                                            </label>
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
                    
                    @endforeach
                    @endfor
                </div>
            </div>

        </div>
    </div>
        

</div>


<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        const fileInput = document.getElementById('file-input');
        const fileName = document.getElementById('file-name');
        const fileNameContainer = document.getElementById('file-name-container');

        fileInput.addEventListener('change', () => {
            fileName.textContent = "Le fichier selectionne est " + fileInput.files[0].name;
            fileNameContainer.classList.remove('d-none');
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const fileInput = document.getElementById('file-input2');
        const fileName = document.getElementById('file-name2');
        const fileNameContainer = document.getElementById('file-name-container2');

        fileInput.addEventListener('change', () => {
            fileName.textContent = "Le fichier selectionne est " + fileInput.files[0].name;
            fileNameContainer.classList.remove('d-none');
        });
    });

    function ajoutVille() {
        var regionSelect = document.querySelector('select[name="idRegion"]');
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