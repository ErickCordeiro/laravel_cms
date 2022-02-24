@extends('adminlte::page')

@section('title', 'Usuários')

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
            <form class="form-horizontal" >
                <div class="card-header">
                    <div class="row m-2">
                        <div class="col-sm-6">
                            <h2>Visualizar o Usuários</h2>
                        </div>
                        <div class="col-sm-6">
                            <a class=" my-1 mx-2 float-sm-right btn btn-danger" href="{{ route('admin.users') }}">
                                Voltar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="userName">Nome Completo</label>
                        <div class="col-sm-6">
                            <input readonly autofocus="true" type="text"
                                class="form-control @error('name') is-invalid @enderror" id="userName" name="name"
                                placeholder="Nome Completo" value="{{ $user->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="userMail" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-6">
                            <input readonly type="email"
                                class="form-control @error('email') is-invalid @enderror" id="userMail" name="email"
                                placeholder="E-mail" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="userAdmin" class="col-sm-2 col-form-label">Administrador?</label>
                        <div class="col-sm-6">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input readonly type="checkbox" {{($user->is_admin == 1)? 'checked': '';}} 
                                    name="isAdmin" class="custom-control-input" id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3">Vermelho para funcionário e Verde para Administrador</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="userPassword" class="col-sm-2 col-form-label">Senha</label>
                        <div class="col-sm-6">
                            <input readonly type="password" class="form-control @error('password') is-invalid @enderror"
                                id="userPassword" name="password" placeholder="Senha">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="userPasswordConfirmed" class="col-sm-2 col-form-label">Confirme a Senha</label>
                        <div class="col-sm-6">
                            <input readonly type="password" class="form-control" id="userPasswordConfirmed"
                                name="password_confirmation" placeholder="Confirme a Senha">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
