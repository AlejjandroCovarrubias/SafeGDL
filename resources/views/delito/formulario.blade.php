<x-layout title="formulario delito">
    <div class="site-section container">
        <div class="col-md-8 blog-content">
            <h3 class="mb-5">Reportar delito</h3>
            <form action="{{ route('delito.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tipoDelito">¿Que tipo de delito fue?</label>
                    <input type="text" class="form-control" id="tipoDelito" name="tipoDelito">
                </div>
                <div class="form-group">
                    <label for="fecha">Ingresa la fecha y la hora aproximada en que ocurrio el delito</label><br>
                    <input type="datetime-local" id="fecha" name="fecha">
                </div>

                <!-- inicia mapa para Reportar  -->
                <label for="">Selecciona el lugar del reporte</label>
                <div id="mapa_reportar" style="height: 400px; width: 120%;"></div>

                <input type="hidden" name="latitud" id="latitud">
                <input type="hidden" name="longitud" id="longitud">


                
                <!-- termina mapa para Reportar  -->

                <div class="form-group">
                    <label for="descripcion">Describe el delito</label>
                    <textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Reportar" class="btn btn-primary btn-md text-white">
                </div>
            </form>
        </div>
    </div>
@push('scripts')
    <script>
        const key = 'jY2HEnlUCVqLzq9kOHFe';
    </script>
    <script src="{{ asset('js/map.js') }}"></script>
@endpush
</x-layout>
<script src="{{ asset('js/nodoReportado.js') }}"></script>