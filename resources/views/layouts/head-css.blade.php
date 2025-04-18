@yield('css')

<!-- Layout config Js -->
<script src="{{ URL::asset('assets/js/layout.js') }}"></script>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Plugin CSS (External) -->
<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css" rel="stylesheet" />

<!-- FilePond -->
<link href="https://unpkg.com/filepond@4.30.4/dist/filepond.min.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview@4.6.12/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />

<!-- Core App CSS -->
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
