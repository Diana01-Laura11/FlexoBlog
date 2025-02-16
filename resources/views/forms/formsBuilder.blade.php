@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    {{-- <link rel="stylesheet" href="public/assets/css/formsStyles.css"> --}}
@endsection
<link rel="stylesheet" href="{{ asset('assets/css/formsStyles.css') }}">
<title>Crear Mi Formulario</title>
{{-- CLASE QUE HACE REFERENCIA AL ESTILO CSS --}}
{{-- <body  class="headerInit"> --}}

<body>
    <header class="pruebas"></header>
    <div id="build-wrap"></div>
</body>
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
@endsection
