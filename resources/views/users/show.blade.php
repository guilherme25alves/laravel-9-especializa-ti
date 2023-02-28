@extends('layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')
    <h1>Listagem do Usuário {{ $user->name }}</h1>

    <ul>
        <li>{{ $user->name }}</li>
        <li>{{ $user->email }}</li>
    </ul>

    <form action="{{ route('users.delete', $user->id) }}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit">Deletar</button>
    </form>

@endsection