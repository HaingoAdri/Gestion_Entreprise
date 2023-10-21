
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
              <div class="col-lg-6 col-md-10">
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

                    <h4 class="text-dark mb-6 text-center">Connexion</h4>

<<<<<<< Updated upstream
                    <form method="POST" action="{{ route('authentification_connexion') }}">
                      @csrf
=======
                    <form action="{{ route('authentification_connexion') }}">
                    @csrf
>>>>>>> Stashed changes
                      <div class="row">
                        <div class="form-group col-md-12 mb-4">
                          <input type="email" class="form-control input-lg" id="email" aria-describedby="emailHelp" name="email" @if (session('email')) value="{{ session('email') }}" @endif placeholder="Email" required>
                        </div>
                        <div class="form-group col-md-12 mb-4">
                          <input type="password" class="form-control input-lg" id="password" placeholder="Password" name="mot_de_passe" @if (session('mot_de_passe')) value="{{ session('mot_de_passe') }}" @endif required>
                        </div>
                        <div class="form-group col-md-12 mb-4">
                          <select class="form-control" name="module" required>
                            @foreach($listeModules as $module)
                              <option value="{{ $module->id }}">
                                {{ $module->type }}
                              </option>
                            </tr>
                            @endforeach
                          </select>
                        </div>
                        @if (session('erreur'))
                        <div class="form-group col-md-12 mb-4">
                          <p style="color: red;">{{ session('erreur') }}</p>
                        </div>
                        @endif
                        <div class="col-md-12">

                          <div class="d-flex justify-content-between mb-3">

                            <a class="text-color" href="#"> Forgot password? </a>

                          </div>

                          <button type="submit" class="btn btn-primary btn-pill mb-4">Connexion</button>

                          <p>Pas encore de compte ?
                            <a class="text-blue" href="{{ route('inscription') }}">Inscription</a>
                          </p>
                          <p>Se connecter en tant que 
                            <a class="text-blue" href="{{ route('login') }}">Client</a>
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
