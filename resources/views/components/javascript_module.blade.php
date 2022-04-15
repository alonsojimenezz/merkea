@isset($module)
    <script type="module" src="{{ asset('assets/modules/' . $module) }}.js?v={{ date('YmdH') }}"></script>
@endisset
