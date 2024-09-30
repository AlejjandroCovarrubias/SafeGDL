<x-layout title="delitos">
    <div class="container-fluid testimonial py-3 p-4">
        <h4>Aqui voy a mostrar los delitos</h4>
    </div>
    @foreach($delitos as $delito)
    <div class="container-fluid py-1">
        <div class="container py-3">
            <div class="bg-light rounded p-4 position-relative">
                <a href="#">
                    <div class="mb-4 d-flex align-items-center flex-nowrap">
                        <div class="ms-4 d-block d-block border-bottom border-secondary">
                            <h4 class="text-dark">{{ $delito->tipoDelito }}</h4>
                        </div>
                    </div>
                </a>
                <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                <div class="mb-2 pb-1">
                    <p class="mb-0">{{ Str::limit ($delito->descripcion, 300, '...') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-layout>