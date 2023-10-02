<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Mono - Responsive Admin & Dashboard Template</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{ asset('plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{ asset('plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
  
  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />

  


  <!-- FAVICON -->
  <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />
  <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>
  
</head>

</head>
  <body class="bg-light-gray" id="body">
          <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
          <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
              <div class="col-lg-6 col-xl-5 col-md-10 ">
                <div class="card card-default mb-0">
                  <div class="card-header pb-0">
                    <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                      <a class="w-auto pl-0" href="/index.html">
                        <img src="{{ asset('images/logo.png') }}" alt="Mono">
                        <span class="brand-name text-dark">MONO</span>
                      </a>
                    </div>
                  </div>
                  <div class="card-body px-5 pb-5 pt-0">
                    <h4 class="text-dark text-center mb-5">Inscription</h4>
                    <form action="{{ route('authentification_inscription') }}">
                      <div class="row">
                        <div class="form-group col-md-12 mb-4">
                          <input type="text" class="form-control input-lg" id="nom" name="nom" aria-describedby="nameHelp" placeholder="Nom">
                        </div>
                        <div class="form-group col-md-12 mb-4">
                          <input type="text" class="form-control input-lg" id="prenom" name="prenom" aria-describedby="nameHelp" placeholder="Prenom">
                        </div>
                        <div class="form-group col-md-12 mb-4">
                          <input type="email" class="form-control input-lg" id="email" name="email" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                        <div class="form-group col-md-12 mb-4">
                          <select class="form-control" name="module">
                            @foreach($listeModules as $module)
                              <option value="{{ $module->id }}">
                                {{ $module->type }}
                              </option>
                            </tr>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-12 ">
                          <input type="password" class="form-control input-lg" id="mot_de_passe" name="mot_de_passe" placeholder="Password">
                        </div>
                        <div class="form-group col-md-12 ">
                          <input type="password" class="form-control input-lg" id="cmot_de_passe" name="cmot_de_passe" placeholder="Confirm Password">
                        </div>
                        <div class="col-md-12">

                          <button type="submit" class="btn btn-primary btn-pill mb-4">Inscritpion</button>

                          <p>Deja inscris ?
                            <a class="text-blue" href="{{ route('connexion') }}">Connexion</a>
                          </p>
                        </div>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

</body>
</html>
