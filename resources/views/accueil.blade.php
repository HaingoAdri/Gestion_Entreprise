@extends("template.header")

@section("contenu")
        
  <!-- Header -->
    <header class="main-header" id="header">
      <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
          <span class="sr-only">Toggle navigation</span>
        </button>

        <span class="page-title">dashboard</span>

        <div class="navbar-right ">

          <!-- search form -->
          <div class="search-form">
            <form action="index.html" method="get">
              <div class="input-group input-group-sm" id="input-group-search">
                <input type="text" autocomplete="off" name="query" id="search-input" class="form-control" placeholder="Search..." />
                <div class="input-group-append">
                  <button class="btn" type="button">/</button>
                </div>
              </div>
            </form>
            <ul class="dropdown-menu dropdown-menu-search">

              <li class="nav-item">
                <a class="nav-link" href="index.html">Morbi leo risus</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.html">Dapibus ac facilisis in</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.html">Porta ac consectetur ac</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.html">Vestibulum at eros</a>
              </li>

            </ul>

          </div>

          <ul class="nav navbar-nav">

            <!-- User Account -->
            <li class="dropdown user-menu">
              <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                <img src="{{ asset('images/user/user-xs-01.jpg') }}" class="user-image rounded-circle" alt="User Image" />
                <span class="d-none d-lg-inline-block">John Doe</span>
              </button>
             <ul class="dropdown-menu dropdown-menu-right">
                <li>
                  <a class="dropdown-link-item" href="user-profile.html">
                    <i class="mdi mdi-account-outline"></i>
                    <span class="nav-text">My Profile</span>
                  </a>
                </li>

                <li class="dropdown-footer">
                  <a class="dropdown-link-item" href="sign-in.html"> <i class="mdi mdi-logout"></i> Log Out </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>

    </header>

    <!-- ====================================
    ——— CONTENT WRAPPER
    ===================================== -->
    <div class="content-wrapper">
      <div class="content">                
        <!-- Top Statistics -->
        <div class="row">
          <div class="col-xl-3 col-sm-6">
            <div class="card card-default card-mini">
              <div class="card-header">
                <h2>$18,699</h2>
                  <div class="dropdown">
                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                  <div class="sub-title">
                    <span class="mr-1">Sales of this year</span> |
                    <span class="mx-1">45%</span>
                    <i class="mdi mdi-arrow-up-bold text-success"></i>
                  </div>
              </div>
              <div class="card-body">
                <div class="chart-wrapper">
                  <div>
                    <div id="spline-area-1"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card card-default card-mini">
              <div class="card-header">
                <h2>$14,500</h2>
                <div class="dropdown">
                  <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
                <div class="sub-title">
                  <span class="mr-1">Expense of this year</span> |
                  <span class="mx-1">50%</span>
                  <i class="mdi mdi-arrow-down-bold text-danger"></i>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-wrapper">
                  <div>
                    <div id="spline-area-2"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card card-default card-mini">
              <div class="card-header">
                <h2>$4199</h2>
                <div class="dropdown">
                  <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </a>
                      
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
                <div class="sub-title">
                  <span class="mr-1">Profit of this year</span> |
                  <span class="mx-1">20%</span>
                  <i class="mdi mdi-arrow-down-bold text-danger"></i>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-wrapper">
                  <div>
                    <div id="spline-area-3"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card card-default card-mini">
              <div class="card-header">
                <h2>$20,199</h2>
                <div class="dropdown">
                  <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
                <div class="sub-title">
                  <span class="mr-1">Revenue of this year</span> |
                  <span class="mx-1">35%</span>
                  <i class="mdi mdi-arrow-up-bold text-success"></i>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-wrapper">
                  <div>
                    <div id="spline-area-4"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-xl-8">
            
            <!-- Income and Express -->
            <div class="card card-default">
              <div class="card-header">
                <h2>Income And Expenses</h2>
                <div class="dropdown">
                  <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" data-display="static">
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>

              </div>
              <div class="card-body">
                <div class="chart-wrapper">
                  <div id="mixed-chart-1"></div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-xl-4">
            <!-- Current Users  -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Current Users</h2>
                    <span>Realtime</span>
                </div>
                <div class="card-body">
                    <div id="barchartlg2"></div>
                </div>
                <div class="card-footer bg-white py-4">
                    <a href="#" class="text-uppercase">Current Users Overview</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
