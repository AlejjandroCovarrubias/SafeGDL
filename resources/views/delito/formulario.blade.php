<x-layout title="formulario delito">
    <div class="site-section container">
        <div class="col-md-8 blog-content">
            <h3 class="mb-5">Reportar delito</h3>
            <form action="{{ route('delito.store') }}" method="POST">
                @csrf 
                
                    <label for="tipoDelito">¿Qué tipo de delito fue?</label>
                    <select class="form-control" id="tipoDelito" name="tipoDelito">
                        <option value="" disabled selected>Selecciona el tipo de delito</option>
                        <option value="Robo">Robo</option>
                        <option value="Asalto">Asalto</option>
                        <option value="Vandalismo">Vandalismo</option>
                        <option value="Fraude">Fraude</option>
                        <option value="Acoso">Acoso</option>
                    </select>
                <div class="form-group">
                    <label for="fecha">Ingresa la fecha y la hora aproximada en que ocurrió el delito</label><br>
                    <input type="datetime-local" id="fecha" name="fecha" class="form-control">
                </div>
                <div class="form-group">
                    <label for="latitud">Ingresa la latitud</label>
                    <input type="text" class="form-control" id="latitud" name="latitud">
                </div>
                <div class="form-group">
                    <label for="longitud">Ingresa la longitud</label>
                    <input type="text" class="form-control" id="longitud" name="longitud">
                </div>
                <div class="form-group">
                    <label for="descripcion">Describe el delito</label>
                    <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Reportar" class="btn btn-primary btn-md text-white">
                </div>
            </form>
        </div>
    </div>

    <!-- Incluye Tom Select y el estilo personalizado -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@1.7.8/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@1.7.8/dist/js/tom-select.complete.min.js"></script>

    <style>
        /* Ajusta la altura del cuadro seleccionado dentro de Tom Select */
        .ts-control .item {
            padding: 4px 8px; 
            font-size: 14px; 
            line-height: 1.2; 
        }

        /* Ajusta el tamaño del contenedor del select */
        .ts-control {
            height: auto;
            padding: 4px 8px; 
        }

        /* Estilo de las opciones desplegables */
        .ts-dropdown .option {
            padding: 10px;
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            color: #495057;
        }

        .ts-dropdown .option:hover {
            background-color: #f8f9fa;
        }

        /* Estilo de la opción seleccionada */
        .ts-dropdown .option.selected {
            background-color: #e2e6ea;
            color: #212529;
        }
    </style>

    <script>
        const select = new TomSelect("#tipoDelito", {
            create: false,
            maxOptions: 5, 
            sortField: {
                field: "text",
                direction: "asc"
            },
            dropdownDirection: 'auto',
            placeholder: "Selecciona el tipo de delito" 
        });

        select.on('item_add', function() {
            select.settings.placeholder = ""; 
            select.control_input.removeAttribute("placeholder"); 
        });
    </script>
</x-layout>


