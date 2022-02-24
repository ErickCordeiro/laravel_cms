@extends('adminlte::page')

@section('title', 'Usuários')

@section('content')
    @if ($errors->any())
        <div class="container-fluid py-2">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Atenção!</h5>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                </div>
        </div>
    @endif
    <div class="container-fluid pt-4">
        <div class="card">
            <form class="form-horizontal" action="{{ route('admin.users.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <div class="row m-2">
                        <div class="col-sm-6">
                            <h2>Cadastro de Usuários</h2>
                        </div>
                        <div class="col-sm-6">
                            <button class="my-1 mx-2 float-sm-right btn btn-success">Salvar Registro</button>
                            <a class=" my-1 mx-2 float-sm-right btn btn-danger" href="{{ route('admin.users') }}">
                                Cancelar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="userName">Nome Completo</label>
                        <div class="col-sm-6">
                            <input autofocus="true" type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="userName" name="name" placeholder="Nome Completo">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="userMail" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-6">
                            <input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="userMail" name="email" placeholder="E-mail">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="userPassword" class="col-sm-2 col-form-label">Senha</label>
                        <div class="col-sm-6"> 
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="userPassword" name="password"
                                placeholder="Senha">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="userPasswordConfirmed" class="col-sm-2 col-form-label">Confirme a Senha</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="userPasswordConfirmed"
                                name="password_confirmation" placeholder="Confirme a Senha">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
