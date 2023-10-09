@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header align-items-center px-3 px-md-5">
                <h2>Les annonces</h2>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> 
                    Ajouter vos besoins
                </button>
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
        </div>
    </div>


    <!-- Contact Modal -->
    <div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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

    <!-- Add Besoin Poste, Horaire, TJH, Service  -->
    <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('insertion_Besoin') }}">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Mes Besoins</h5>
                    </div>
                    <div class="modal-body px-4">

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Nom du Poste</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                @foreach($listePostes as $poste)
                                  <select name="poste_id" class="form-control">
                                    <option value="{{ $poste->id }}">{{ $poste->type }}</option>
                                  </select>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Service</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  @foreach($listeServices as $service)
                                    <select name="service_id" class="form-control">
                                      <option value="{{ $service->id }}">{{ $service->type }}</option>
                                    </select>
                                  @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Horaires</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="number" class="form-control" id="horaireBesoin" name="horaireBesoin">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">TJH</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                  <input type="number" class="form-control" id="tjh" name="tjh">
                                </div>
                            </div>
                        </div>
                        

                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pill">Suivant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script defer>
   
    document.querySelector("#ajout-age").addEventListener("click", () => {
        ajoutDeLigneAge()
    })
    document.querySelector("#supprimer-age").addEventListener("click", () => {
        deleteLigneAge()
    })

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
       document.getElementById("line-container").deleteRow(1);
   }

</script>

@endsection