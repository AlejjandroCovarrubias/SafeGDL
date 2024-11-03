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
                <li class="active"><a href="/" class="nav-link">Home</a></li>
                <li><a href="{{ route('delito.create') }}" class="nav-link">Reportar</a></li>
                <li><a href="trips.html" class="nav-link">Trips</a></li>
                <li><a href="blog.html" class="nav-link">Blog</a></li>
                <li><a href="contact.html" class="nav-link">Contact</a></li>
              </ul>
            </nav>

            <a href="#" id="share-button" class="location-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-house">
                <path d="M15 22a1 1 0 0 1-1-1v-4a1 1 0 0 1 .445-.832l3-2a1 1 0 0 1 1.11 0l3 2A1 1 0 0 1 22 17v4a1 1 0 0 1-1 1z" />
                <path d="M18 10a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 .601.2" />
                <path d="M18 22v-3" />
                <circle cx="10" cy="10" r="3" />
              </svg>
            </a>


            <a href="tel:911" id="panic-button" class="emergency-icon">
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
            <h2 class="footer-heading mb-3">El template</h2>
            <div class="row">
              <div>
                <a href="https://themewagon.com/themes/free-bootstrap-4-html5-travel-business-website-template-trips/" target="on_blank">Descarguen el template weyes</a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 ml-auto">
            <div class="row">
              <div class="col-lg-6 ml-auto">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Terms of Service</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <h2 class="footer-heading mb-4">Newsletter</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt odio iure animi ullam quam, deleniti rem!</p>
                <form action="#" class="d-flex" class="subscribe">
                  <input type="text" class="form-control mr-3" placeholder="Email">
                  <input type="submit" value="Send" class="btn btn-primary">
                </form>
              </div>

            </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
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

<script>
    document.getElementById('share-button').addEventListener('click', function(event) {
      event.preventDefault();

      // Verifica si el navegador soporta la API de geolocalización
      if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(
          function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Crea un enlace para compartir en Google Maps
            const googleMapsUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;
            
            // Comparte el enlace en la consola o usa navigator.share si está disponible
            if (navigator.share) {
              navigator.share({
                title: 'Mi ubicación actual',
                text: 'Aquí está mi ubicación actual:',
                url: googleMapsUrl
              }).then(() => console.log('Ubicación compartida exitosamente'))
                .catch(console.error);
            } else {
              // Alternativamente, abre la URL en una nueva pestaña
              window.open(googleMapsUrl, '_blank');
            }
          },
          function(error) {
            alert('No se pudo obtener la ubicación: ' + error.message);
          }
        );
      } else {
        alert('La geolocalización no está soportada en este navegador.');
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
  @livewireScripts
  @stack('scripts')
</body>

</html>