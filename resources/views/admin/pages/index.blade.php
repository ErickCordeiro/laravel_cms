@extends('adminlte::page')

@section('title', 'Usuários')
@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listagem de Páginas</h1>
            </div>
            <div class="col-sm-6">
                <a class="float-sm-right btn btn-small btn-success" href="{{ route('admin.pages.create') }}"> Adicionar
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

    @if (session('warning'))
        <div class="container-fluid py-2">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>
                {{ session('warning') }}
            </div>
        </div>
    @endif

    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <th width="85%">Título</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @foreach ($pages as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href=" {{ route('admin.pages.edit', ['page' => $item->id]) }}">
                                        <i class="fas fa-pencil-alt"></i></a>

                                    <form class="d-inline"
                                        action="{{ route('admin.pages.destroy', ['page' => $item->id]) }}" method="POST"
                                        onsubmit="return confirm('Você realmente deseja excluir esse registro?')">
                                        @method("DELETE")
                                        @csrf
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Páginação das Páginas -->
        {{ $pages->links() }}
    </div>
@endsection
