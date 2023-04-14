@extends('layouts.app')

@section('title', 'Editar novo Usuario')
@section('content')
    <h1>Editar o Usuario - {{ $user->name }}</h1>
    @include('includes.validation-form')
    <form action="{{route('users.update', $user->id)}}" method="post">
        @method('PUT')
        @csrf
        @include('users._partials.form')
        <button type="submit">Editar</button>
    </form>
@endsection
