@extends('web::layout.app')

@section('title', 'Ticket')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-xs-12">
            <div class="d--flex j--space-between ai--center">
                <h2>Adicionar Ticket</h2>

                <div>
                    <a class="btn btn-success add-ticket">Salvar</a>
                </div>
            </div>

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <span>Adicionar</span>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        @if($message = session('message'))
            @if(session('status') == '00')
                <div class="alert alert-info">
                    {{ $message }}
                </div>
            @else
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif
        @endif
        <form method="post" id="frm-add-ticket" action="{{ route('web.ticket.store') }}">
            {{ csrf_field() }}
            <div class="row refund-list">
                <div class="col-xs-12">
                    <div class="ibox">
                        <div class="ibox-content refund">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="nome">Nome do Cliente<small>*</small></label>
                                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do Cliente" maxlength="255" value="{{ old('nome') }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="email">E-mail<small>*</small></label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" maxlength="255" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="numpedido">Nº do Pedido<small>*</small></label>
                                        <input type="text" name="numpedido" id="numpedido" class="form-control digits" placeholder="Nº do Pedido" maxlength="8" value="{{ old('numpedido') }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="titulo">Título do Ticket<small>*</small></label>
                                        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título do Ticket" maxlength="150" value="{{ old('titulo') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="descricao">Conteúdo do Ticket<small>*</small></label>
                                        <input type="text" name="descricao" id="descricao" class="form-control" maxlength="255" placeholder="Conteúdo do Ticket" value="{{ old('descricao') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{!! asset('js/jquery.mask.min.js') !!}"></script>
    <script src="{!! asset('js/functions.js') !!}"></script>
    <script src="{!! asset('libs/matchHeight/jquery.matchHeight.min.js') !!}"></script>
    <script src="{!! asset('js/modal/modal.js') !!}"></script>
    <script src="{!! asset('js/modal/template.js') !!}"></script>
    @include('web::ticket.javascript.create')
@endsection
