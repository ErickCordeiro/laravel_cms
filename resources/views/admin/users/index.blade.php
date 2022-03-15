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

    @if (session('success'))
        <div class="container-fluid py-2">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-bordered table-striped">
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
                                <td>{{ $item->is_admin == 1 ? 'Administrador' : 'Funcionário' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href=" {{ route('admin.users.edit', ['user' => $item->id]) }}">
                                        <i class="fas fa-pencil-alt"></i></a>

                                    <a class="btn btn-sm btn-warning"
                                        href=" {{ route('admin.users.show', ['user' => $item->id]) }}">
                                        <i class="fas fa-eye"></i></a>

                                    @if (Auth::id() != $item->id)
                                        <form class="d-inline"
                                            action="{{ route('admin.users.destroy', ['user' => $item->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Você realmente deseja excluir esse registro?')">
                                            @method("DELETE")
                                            @csrf
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Páginação de usuários -->
        {{ $users->links() }}
    </div>
@endsection
