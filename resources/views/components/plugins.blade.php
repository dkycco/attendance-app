@switch($name)
    @case('datatable')
        @push('css')
        <link href="{{ asset('libs/datatables/datatables.min.css') }}" rel="stylesheet">
        @endpush

        @push('vendors')
        <script src="{{ asset('libs/datatables/datatables.min.js') }}"></script>
        @endpush
    @break

    @case('select2')
        @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
        @endpush

        @push('vendors')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @endpush
    @break

    @case('datepicker')
        @push('css')
            <link href="{{ asset('libs/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css">
        @endpush

        @push('vendors')
            <script src="{{ asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        @endpush
    @break

    @case('sweetalert')
        @push('css')
            <link rel="stylesheet" href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
        @endpush

        @push('vendors')
            <script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>
        @endpush
    @break

    @case('swiper')
        @push('css')
            <link rel="stylesheet" href="{{ asset('libs/swiper/swiper-bundle.min.css') }}">
        @endpush

        @push('vendors')
            <script src="{{ asset('libs/swiper/swiper-bundle.min.js') }}"></script>
        @endpush
    @break

    @case('flatpickr')
        @push('vendors')
            <script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
        @endpush
    @break

    @default
@endswitch
