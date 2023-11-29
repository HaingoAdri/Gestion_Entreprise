@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default border-0 bg-transparent">
            <div class="card-header align-items-center p-0">
                <h2>Envoyer un Email</h2>
            
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-event">
                    <i class="mdi mdi-plus mr-1"></i> Faire une demande
                </button>
            </div>
            @if(session("erreur") != null)
                <div class="alert alert-danger" role="alert">
                    <h6>{{ session("erreur") }}</h6>
                </div>
            @endif
            @if(session("success") != null)
                <div class="alert alert-success" role="alert">
                    <h6>{{ session("success") }}</h6>
                </div>
            @endif
        </div>

        <!-- Add Event Button  -->
        <div class="modal fade" id="modal-add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('demande_proforma') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Demande</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body px-4">

                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="custom-file-upload color-pink">
                                        <input type="file" name="file_justificatif" id="file-input" size="20" accept=".pdf"/>
                                        <i class="mdi mdi-calendar-import"></i> Import dernier proforma
                                        <div id="file-name-container">
                                            <p id="file-name"></p>
                                            <p id="file-path"></p>
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
        const filePath = document.getElementById('file-path');
        const fileNameContainer = document.getElementById('file-name-container');

        fileInput.addEventListener('change', () => {
            fileName.textContent = "Le fichier selectionne est " + fileInput.files[0].name;
            fileNameContainer.classList.remove('d-none');
        });
    });

</script>
@endsection
