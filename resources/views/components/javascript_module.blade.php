@isset($module)
    <script type="module" src="{{ asset('assets/modules/' . $module) }}.js?v={{ date('Ymd') }}"></script>
@endisset
