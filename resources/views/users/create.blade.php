@extends('layouts.app')

@section('title', 'Criar novo Usuario')
@section('content')
    <h1>Novo Usuario</h1>
    @include('includes.validation-form')
    <form action="{{route('users.store')}}" method="POST">
        @csrf
        @include('users._partials.form')
        <button type="submit">Cadastrar</button>
    </form>
@endsection
