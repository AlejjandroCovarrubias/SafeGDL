<x-layout title="formulario delito">
    <div class="container">
        <div class="col-md-8 blog-content">
            <h3 class="mb-5">Reportar delito</h3>
            <form action="#" class="">
                <div class="form-group">
                    <label for="tipoDelito">¿Que tipo de delito fue?</label>
                    <input type="text" class="form-control" id="tipoDelito">
                </div>
                <div class="form-group">
                    <label for="fecha">Ingresa la fecha y la hora en que ocurrio el delito</label><br>
                    <input type="datetime-local" id="fecha" name="fecha">
                </div>
                <div class="form-group">
                    <label for="longitudlatitud">Ingresa la latitud</label>
                    <input type="url" class="form-control" id="latitud">
                </div>
                <div class="form-group">
                    <label for="longitud">>Ingresa la longitud</label>
                    <input type="url" class="form-control" id="longitud">
                </div>
                <div class="form-group">
                    <label for="descripcion">Describe el delito</label>
                    <textarea name="" id="descripcion" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Reportar" class="btn btn-primary btn-md text-white">
                </div>
            </form>
        </div>
    </div>
</x-layout>