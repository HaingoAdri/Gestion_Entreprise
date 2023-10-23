@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default border-0 bg-transparent">
            <div class="card-header align-items-center p-0">
                <h2>Demande de conges & absences</h2>
            
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-event">
                    <i class="mdi mdi-plus mr-1"></i> Faire une demande
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-default">

                    <div class="card-title text-center">
                        <h4>Indemnites de conges</h4>
                    </div>
                
                    <div class="card-body pt-0">
                        <ul class="nav nav-profile-follow justify-content-center">
                            <li class="nav-item text-center" style="margin-right: 2rem;">
                                <a class="nav-link" href="#">
                                    <span class="h1 d-block">{{ $congeAcquis }}</span>
                                    <span class="text-color d-block">Acquis</span>
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link" href="#">
                                    <span class="h1 d-block">{{ $congeSolde }}</span>
                                    <span class="text-color d-block">Solde</span>
                                </a>
                            </li>
                            <li class="nav-item text-center" style="margin-left: 2rem;">
                                <a class="nav-link" href="#">
                                    <span class="h1 d-block">{{ $congePris }}</span>
                                    <span class="text-color d-block">Pris</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    @if(session("erreur") != null)
                    <div class="alert alert-danger" role="alert">
                        <h6>{{ session("erreur") }}</h6>
                    </div>
                    @endif

                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-body p-0">
                        <div class="full-calendar">
                        <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Event Button  -->
        <div class="modal fade" id="modal-add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('insertion_conge') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Demande</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body px-4">

                            <div class="form-group">
                                <label for="firstName">Type de conges</label>
                                <!-- <input type="text" class="form-control" value="Meeting"> -->
                                <select class="form-control" name="type_conge">
                                @if( count($listeTypeConges) > 0)
                                    @foreach($listeTypeConges as $type_conge)
                                    <option value="{{ $type_conge->id }}">{{ $type_conge->nom }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
  
                            <div class="form-group mb-0">
                                <label for="firstName">Raison</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="raison"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Debut</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text py-1">
                                                <i class="mdi mdi-calendar-range"></i>
                                            </span>
                                            </div>
                                            <input type="datetime-local" class="form-control" name="dateDebut" value="" placeholder="Date"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Fin</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text py-1">
                                                    <i class="mdi mdi-calendar-range"></i>
                                                </span>
                                            </div>
                                            <input type="datetime-local" class="form-control" name="dateFin" value="" placeholder="Date"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label class="custom-file-upload color-pink">
                                        <input type="file" name="file_justificatif" id="file-input" size="20" accept=".pdf"/>
                                        <i class="mdi mdi-calendar-import"></i> Import Justificatif
                                        <div id="file-name-container">
                                            <p id="file-name"></p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer border-top-0 px-4 pt-0">
                            <button type="submit" class="btn btn-primary btn-pill m-0">Creat Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fileInput = document.getElementById('file-input');
        const fileName = document.getElementById('file-name');
        const fileNameContainer = document.getElementById('file-name-container');

        fileInput.addEventListener('change', () => {
            fileName.textContent = "Le fichier selectionne est " + fileInput.files[0].name;
            fileNameContainer.classList.remove('d-none');
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");
    var year = new Date().getFullYear();
    var month = new Date().getMonth() + 1;
    function n(n) {
        return n > 9 ? "" + n : "0" + n;
    }
    var month = n(month);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ["dayGrid"],
        defaultView: "dayGridMonth",

        eventRender: function (info) {
        var ntoday = moment().format("YYYYMMDD");
        var eventStart = moment(info.event.start).format("YYYYMMDD");
        info.el.setAttribute("title", info.event.extendedProps.description);
        info.el.setAttribute("data-toggle", "tooltip");
        if (eventStart < ntoday) {
            info.el.classList.add("fc-past-event");
        } else if (eventStart == ntoday) {
            info.el.classList.add("fc-current-event");
        } else {
            info.el.classList.add("fc-future-event");
        }
        },

        events: [
            @if( count($congeEmployer) > 0)
                @foreach($congeEmployer as $conge)
                    {
                        title: "{{ $conge->type_conge->nom }}",
                        description: "{{ $conge->raison }}",
                        start: "{{ $conge->debut }}",
                        end: "{{ $conge->fin }}"
                    },
                @endforeach
            @endif
        ],
    });

    calendar.render();
    });

</script>
@endsection
