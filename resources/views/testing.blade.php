<x-layout title="titulo de pruebas">
  <div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" style="background-image: url('{{ asset('img/gdl-1.jpg') }}');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-5" data-aos="fade-right">
            <h1 class="mb-3" style="color: #ADD8E6">SafeGDL</h1>
            <p style="font-size: 16px; color: #F5F5F5; line-height: 2.3;">
              Encuentra la mejor ruta para llegar a tu destino con confianza. SafeGDL te guía por caminos más seguros y protegidos, evitando áreas de riesgo para que tu experiencia de viaje sea tranquila y sin preocupaciones.
            </p>
            <p class="d-flex align-items-center">
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="site-section py-5">
    <livewire:map />
  </div>
</x-layout>
