<!doctype html>
<html lang="en">

<head>
  <title>{{ $title }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
  <link rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('fonts/flaticon/font/flaticon.css')}}">
  <link rel="stylesheet" href="{{asset('css/aos.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <!-- API mapa para consulta  -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <!-- SEARCH BAR PLUGIN -->
  <script src="https://cdn.maptiler.com/maptiler-geocoding-control/v1.3.3/leaflet.umd.js"></script>
  <link href="https://cdn.maptiler.com/maptiler-geocoding-control/v1.3.3/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

  <!-- RUTAS  -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="{{asset('css/style.css')}}">

  @livewireStyles

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


  <div class="site-wrap" id="home-section">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>



    <header class="site-navbar site-navbar-target" role="banner">

      <div style="padding-left: 200px; padding-right: 200px;">
        <div class="row align-items-center position-relative">

          <div class="col-3">
            <div class="site-logo">
              <a href="index.html">
                <img src="{{asset('img/safeGDL.png')}}" alt="Image" class="img-fluid">
              </a>
            </div>
          </div>

            <div class="col-9  text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

              

              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li class="active"><a href="/" class="nav-link">Inicio</a></li>
                  <li class="active"><a href="/mapa" class="nav-link">Mapa</a></li>
                  <li><a href="{{ route('delito.create') }}" class="nav-link">Reportar</a></li>
                  <li><a href="{{ route('delito.create') }}" class="nav-link">Contacto</a></li>
                </ul>
              </nav>


            <a href="#" id="panic-button" class="emergency-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone-call">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                <path d="M14.05 2a9 9 0 0 1 8 7.94" />
                <path d="M14.05 6A5 5 0 0 1 18 10" />
              </svg>
            </a>


            <a href="#" id="perfil-icon" style="color: red;">
              <i class="fas fa-user fa-2x"></i>
            </a>


            <div id="menu-opciones" class="oculto">
              <ul>
                <li><a href="{{route('register')}}"><i class="fas fa-user"></i> Registrarse</a></li>
                <li><a href="{{route('login')}}"><i class="fas fa-user"></i> Iniciar sesión</a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>

    </header>


    {{$slot}}


    <div class="ftco-blocks-cover-1">
      <div class="container">
        <div class="mb-3 row align-items-center">

        </div>
      </div>
    </div>



    <footer class="site-footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <h2 class="footer-heading mb-3">Derechos de uso</h2>
            <div class="row">
              <div>
                <ul>
                  <li>Mapa generado mediante la libreria <a href="">Leftlet</a></li>
                  <li>Tipo de mapa cargado mediante la API de <a href="">OpenStreetMap</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-8 ml-auto">
            <div class="row">
              <div class="col-lg-6 ml-auto">
                <h2 class="footer-heading mb-4">Enlaces rápidos</h2>
                <ul class="list-unstyled">
                  <li><a href="#">Inicio</a></li>
                  <li><a href="#">Mapa</a></li>
                  <li><a href="#">Reportar</a></li>
                  <li><a href="#">Mis reportes</a></li>
                  <li><a href="#">Contacto</a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <h2 class="footer-heading mb-4">Redes sociales</h2>
                <p>Para notificaciones y demás información relacionada con la aplicación, te recomendamos seguirnos en nuestras redes.</p>
                <ul class="list-unstyled">
                  <a href="#"><img src="{{asset('img/instagram_icon.png')}}" width="8%"/></a>
                  <a href="#" class="pl-3"><img src="{{asset('img/twitter_icon.png')}}" width="8%"/></a>
                  <a href="#" class="pl-3"><img src="{{asset('img/tiktok_icon.png')}}" width="8%"/></a>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

  </div>


  <script>
    -
    document.getElementById('perfil-icon').addEventListener('click', function(event) {
      event.preventDefault();
      const menu = document.getElementById('menu-opciones');
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    });

    document.addEventListener('click', function(event) {
      const menu = document.getElementById('menu-opciones');
      const icon = document.getElementById('perfil-icon');
      if (menu.style.display === 'block' && !menu.contains(event.target) && !icon.contains(event.target)) {
        menu.style.display = 'none';
      }
    });
  </script>

  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('js/jquery-migrate-3.0.0.js')}}"></script>
  <script src="{{asset('js/popper.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/jquery.sticky.js')}}"></script>
  <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
  <script src="{{asset('js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('js/aos.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  @livewireScripts
  @stack('scripts')
</body>

</html>