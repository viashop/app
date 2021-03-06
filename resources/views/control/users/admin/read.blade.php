@extends('control.app')

@section('form-search')
    {!! Form::open(['url' => route('control.users.admin.read'), 'method' => 'get', 'class' => 'navbar-form navbar-left navbar-search-form', 'role' => 'search'] ) !!}
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-search"></i></span>
        <input type="text" name="search" value="{{ Request('search') }}" class="form-control"
               placeholder="Busca por usuários">
    </div>
    {!! Form::close() !!}
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">

                    <div class="col-xs-6">
                        <h4 class="title"><strong>Admin</strong> - Usuários Adminstrativos
                            @if (Request::get('search'))
                                <a href="{{ route('control.users.admin.read') }}" class="btn btn-default margin"><i
                                            class="fa fa-times-circle" aria-hidden="true"></i> Cancelar busca</a>
                            @endif
                        </h4>
                        <p class="category"><i>Total de usuários cadastrados: <b> {{ $users->total() }}</b> </i></p>
                    </div>

                    <div class="col-xs-6 text-right">
                        @can('read_administrator')
                        <a href="{{ route('control.users.admin.create') }}" class="btn btn-default btn-fill btn-wd"
                           id="new-user"><i class="fa fa-user-plus" aria-hidden="true"></i> Novo Usuário</a>
                        @endcan
                    </div>
                </div>

                <div class="content table-responsive table-full-width">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th class="text-left">Função</th>
                            <th class="text-left">Data Cadastro</th>
                            @can('read_administrator')
                            <th class="text-right" style="width:120px">Ação</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr>

                                <td class="text-center">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td class="text-left">
                                    @foreach($user->roles as $role)
                                        <span class="label label-success">
                                            <a href="{{ route('control.authorization.role.read.permission', $role->id) }}"
                                                    id="view-permission-role-{{ $role->id }}-user-{{ $user->id }}"
                                                    style="color: #ffffff" rel="tooltip"
                                                    title="Visualizar Permissões">{{ $role->description }}
                                            </a>
                                        </span>
                                        &nbsp;
                                    @endforeach
                                </td>

                                <td>{{ tools_format_do_date( $user->created_at ) }}</td>

                                @can('read_administrator')
                                <td class="td-actions text-right">

                                    <a href="{{ route('control.users.admin.update', $user->id) }}" rel="tooltip"
                                       id="edit-user-{{ $user->id }}" title="Editar"
                                       class="btn btn-primary btn-simple btn-xs">
                                        <i class="fa fa-pencil-square fa-2x"></i>
                                    </a>

                                    <a href="javascript://"
                                       onclick="custom.showSwalUser('password-message-confirmation', '{{ route('control.users.admin.new.password', $user->id) }}', '{{ $user->email }}')"
                                       rel="tooltip" title="Gerar nova senha" class="btn btn-warning btn-simple btn-xs">
                                        <i class="fa fa-envelope-square fa-2x"></i>
                                    </a>

                                    <a href="javascript://"
                                       onclick="custom.showSwalUser('delete-message-confirmation', '{{ route('control.users.admin.delete', $user->id) }}', '{{ $user->name }}')"
                                       rel="tooltip" title="Remover" class="btn btn-danger btn-simple btn-xs"
                                       title="Remover da Administração">
                                        <i class="fa fa-trash fa-2x"></i>
                                    </a>

                                </td>
                                 @endcan

                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $users->appends(['search' => $search])->render() !!}
        </div>
    </div>
@endsection
