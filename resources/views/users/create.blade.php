@extends('layouts.app')

@section('title', 'Criar novo Usuario')
@section('content')
    <h1>Novo Usuario</h1>
    @if($errors->any())
       <ul class="errors">
           @foreach($errors->all() as $error)
               <li class="errors">{{$error}}</li>
           @endforeach
       </ul>
    @endif
    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <input type="text" name="name" id="name" placeholder="Nome:" value="{{old('name')}}">
        <input type="email" name="email" id="email" placeholder="Senha:" value="{{old('email')}}">
        <input type="password" name="password" id="password" placeholder="Senha:">
        <button type="submit">Cadastrar</button>
    </form>
@endsection
