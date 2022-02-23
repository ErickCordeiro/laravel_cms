@extends('adminlte::page')

@section('title', 'Usuários')
@section('content_header')
    <h2>Listagem de Usuários</h2>
@endsection

@section('content')
    @foreach ($users as $item)
        <p>{{ $item->name }}</p>
    @endforeach
@endsection
