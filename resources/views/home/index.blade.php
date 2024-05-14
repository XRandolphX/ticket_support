
{{-- Acá estoy extendiendo del app-master --}}
@extends('layouts.app-master')

@section('content')
    <h1>Home</h1>
    @auth
        <p>Bienvenido {{ auth()->user()->name ?? auth()->user()->username }} estás autenticado en la página</p>
        <p>
            <a href="/logout">Logout</a>
        </p>
    @endauth

    @guest
        <p>Para ver el contenido <a href="/login">Inicia sesión</a></p>
    @endguest
@endsection
