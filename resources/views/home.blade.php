@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    <x-Listar-post :posts="$posts" />
@endsection