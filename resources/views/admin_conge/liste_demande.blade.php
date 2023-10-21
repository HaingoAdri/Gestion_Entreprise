@extends("template.header")

@section("contenu")
<div class="content-wrapper">
    <div class="content"><!-- Card Profile -->
        <div class="card card-default card-profile">

        <div class="card-footer card-profile-footer">
            <ul class="nav nav-border-top justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accueil_Conge') }}">Types de conges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('liste_demande') }}">Demandes de Conges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user-profile-settings.html">Activites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user-profile-settings.html">Settings</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3"></div>
            <div class="col-lg-6" >
                <!-- Notification -->
                <div class="card card-default" data-scroll-height="530">
                    <div class="card-header">
                        <h2 class="mb-5">Demandes</h2>
                    </div>

                <div class="card-body slim-scroll">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action">
                            <div class="media media-sm mb-0">
                            <div class="media-sm-wrapper">
                                <img src="assetes/images/user/user-sm-01.jpg" alt="User Image">
                            </div>
                            <div class="media-body">
                                <span class="title">The stars are twinkling.</span>
                                <p>Extremity sweetness difficult behaviour he of. On disposal of as landlord horrible. Afraid at highly months do things on at.</p>
                            </div>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="media media-sm mb-0">
                                <div class="media-sm-wrapper">
                                    <img src="assetes/images/user/user-sm-02.jpg" alt="User Image">
                                </div>
                                <div class="media-body">
                                    <span class="title">This is a Japanese doll.</span>
                                    <p>Marianne or husbands if at stronger ye. Considered is as middletons uncommonly. Promotion perfectly ye
                                    consisted so.</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="media media-sm mb-0">
                                <div class="media-sm-wrapper">
                                    <img src="assetes/images/user/user-sm-03.jpg" alt="User Image">
                                </div>
                                <div class="media-body">
                                    <span class="title">Support Ticket</span>
                                    <p>Unpleasant nor diminution excellence apartments imprudence the met new. Draw part them he an to he roof
                                    only.
                                    Music
                                    leave say doors him.</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <div class="media media-sm mb-0">
                                <div class="media-sm-wrapper">
                                    <img src="assetes/images/user/user-sm-04.jpg" alt="User Image">
                                </div>
                                <div class="media-body">
                                    <span class="title">New Order</span>
                                    <p>Farther related bed and passage comfort civilly. Dashwoods see frankness objection abilities the. As
                                    hastened
                                    oh
                                    produced prospect formerly up am.</p>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        <div class="col-lg-3"></div>
    </div>
          
</div>
@endsection