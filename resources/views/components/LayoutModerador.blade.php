<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titulo }}</title>
    <link href="{{asset('css/barralateralstyles.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="menu"></div>
    <br><br><br>

    <div style="background-color: #f8f9fa; padding: 20px; text-align: center;"></div>
    
    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <img id="cloud" class="logo" src="{{asset('img/dashboard_moderator.png')}}" alt="">
                <div class="textos">
                    <span class="spanbar dashboard">Dashboard</span>
                    <span class="spanbar">Moderador</span>
                </div>
            </div>
        </div>

        <div class="linea"></div>

        <nav class="navegacion">
            <ul class="sidebar__menu-list">
                <li class="sidebar__menu-item" onclick="toggleSidebar()">
                    <a href="#" class="sidebar__menu-link">
                        <i class="fas fa-utensils"></i>
                        <span class="spanbar">Recetas</span>
                    </a>
                </li>                
                <li class="sidebar__menu-item">
                    <a href="#" class="sidebar__menu-link">
                        <i class="fas fa-comments"></i> 
                        <span class="spanbar">Comentarios</span>
                    </a>
                </li>
                <li class="sidebar__menu-item">
                    <a href="#" class="sidebar__menu-link">
                        <i class="fas fa-user-circle"></i> 
                        <span class="spanbar">Gestionar cuentas</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Aquí va el contenido de las vistas del moderador -->
    <main class="option-grid">
        {{ $slot }}
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('js/sideBar.js')}}"></script>
</body>
</html>

