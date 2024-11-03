<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFEGDL - Lista de Delitos Reportados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Delitos Reportados</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Tipo de Delito</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                </tr>
            </thead>
            <tbody>
                @foreach($delitos as $delito)
                    <tr>
                        <td>{{ $delito->user->name ?? 'Usuario Desconocido' }}</td>
                        <td>{{ $delito->tipoDelito }}</td>
                        <td>{{ $delito->descripcion }}</td>
                        <td>{{ $delito->fecha }}</td>
                        <td>{{ $delito->latitud }}</td>
                        <td>{{ $delito->longitud }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


