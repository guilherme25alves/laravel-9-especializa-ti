
@extends('layouts.app')

@section('title', 'Listagem do Usuário')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Listagem do usuário {{ $user->name }}</h1>

<div class="w-full bg-white shadow-md rounded px-8 py-2">

    <ul>
        <li><b>Nome: </b>{{ $user->name }}</li>
        <li><b>E-mail: </b>{{ $user->email }}</li>
    </ul>

    <form action="{{ route('users.delete', $user->id) }}" method="POST" class="py-12">
        @method('DELETE')
        @csrf
        <button type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
    </form>

</div>
@endsection