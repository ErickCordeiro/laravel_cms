@extends('adminlte::page')

@section('title', 'Páginas')

@section('content')
    @if ($errors->any())
        <div class="container-fluid py-2">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Atenção!</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="container-fluid pt-4">
        <div class="card">
            <form class="form-horizontal" action="{{ route('admin.pages.update', ['page' => $page->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-header">
                    <div class="row m-2">
                        <div class="col-sm-6">
                            <h2>Editar Página</h2>
                        </div>
                        <div class="col-sm-6">
                            <button class="my-1 mx-2 float-sm-right btn btn-success">Salvar Registro</button>
                            <a class=" my-1 mx-2 float-sm-right btn btn-danger" href="{{ route('admin.pages') }}">
                                Cancelar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="title">Título</label>
                        <div class="col-sm-6">
                            <input autofocus="true" type="text"
                                class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                value="{{ $page->title }}" placeholder="Título da Página">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">Conteúdo</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="content" name="content" placeholder="Conteúdo"> {{ $page->content }}</textarea>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
