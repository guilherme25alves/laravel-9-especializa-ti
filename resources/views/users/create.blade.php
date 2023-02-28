@extends('layouts.app')

@section('title', 'Criar Usuário')

@section('content')
    <h1>Novo Usuário</h1>

    @include('includes.validations-form')

    <form action="{{ route('users.store') }}" method="post" >
        @include('users._partials.form')
    </form>
@endsection