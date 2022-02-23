@extends('adminlte::page')

@section('title', 'Usuários')
@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listagem de Usuários</h1>
            </div>
            <div class="col-sm-6">
                <a class="float-sm-right btn btn-small btn-success" href="{{ route('admin.users.create') }}"> Adicionar
                    Novo</a>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-bordered table-striped dataTable dtr-inline"
                    arial-describedby="example_info" id="example1">
                    <thead>
                        <th>Cód.</th>
                        <th>Nome Completo</th>
                        <th>E-mail</th>
                        <th>Função</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>Administrador</td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href=" {{ route('admin.users.edit', ['user' => $item->id]) }}">
                                        <i class="fas fa-pencil-alt"></i></a>

                                    <!-- Colocar o Formulário para excluir o registro com o verbo Delete -->
                                    <a class="btn btn-sm btn-warning" 
                                    href=" {{ route('admin.users.show', ['user' => $item->id]) }}">
                                        <i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
