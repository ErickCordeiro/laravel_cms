@extends('adminlte::page')

@section('title', 'Confgurações Gerais do Site')

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

    @if (session('success'))
    <div class="container-fluid py-2">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
            {{session('success')}}
        </div>
    </div>
@endif
    <div class="container-fluid pt-4">
        <div class="card">
            <form class="form-horizontal" action="{{ route('admin.settings.update', ['code' => $settings->id])}}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-header">
                    <div class="row m-2">
                        <div class="col-sm-6">
                            <h2>Configurações Gerais</h2>
                        </div>
                        <div class="col-sm-6">
                            <button class="my-1 mx-2 float-sm-right btn btn-success">Salvar Registro</button>
                            {{-- <a class=" my-1 mx-2 float-sm-right btn btn-danger" href="{{ route('admin.users') }}">
                                Cancelar</a> --}}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="title">Título do Site</label>
                        <div class="col-sm-6">
                            <input autofocus="true" type="text"
                                class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                placeholder="Título do Site" value="{{$settings->title}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="subtitle">Subtítulo do Site</label>
                        <div class="col-sm-6">
                            <input type="text"
                                class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle"
                                placeholder="SubTítulo" value="{{$settings->subtitle}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="description">Descrição do Site</label>
                        <div class="col-sm-6">
                            <textarea
                                class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                placeholder="Descrição do Site com até 160 Caracteres">{{$settings->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-6">
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                placeholder="E-mail" value="{{$settings->email}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bg_color" class="col-sm-2 col-form-label">Cor do Background</label>
                        <div class="col-sm-6">
                            <input type="color"
                                class="form-control @error('bg_color') is-invalid @enderror" id="bg_color" name="bg_color"
                                value="{{$settings->bg_color}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="font_color" class="col-sm-2 col-form-label">Cor do Texto</label>
                        <div class="col-sm-6">
                            <input type="color"
                                class="form-control @error('font_color') is-invalid @enderror" id="font_color" name="font_color"
                                value="{{$settings->font_color}}">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
