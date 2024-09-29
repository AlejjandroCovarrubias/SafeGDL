<div>
    <div id='map' style="height: 1000px; width: 100%;">
    </div>
    @push('scripts')
        <script>
            const key = @json($key);
        </script>
        <script src="{{ asset('js/map.js') }}"></script>
    @endpush
</div>

