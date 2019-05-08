@extends('web::layout.app')

@section('title', 'Ticket')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-xs-12">
            <div class="d--flex j--space-between ai--center">
                <h2>Tickets</h2>
            </div>

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('web.ticket') }}">Ticket</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>{{ $ticket['id'] }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-xs-12" data-mh="panel">
                <div class="ibox white-bg">
                    <div class="ibox-title">
                        <h5>Informações do Ticket</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="static-group">
                        </div>
                        <div class="jumbotron jumbotron--event m-t-sm p-sm">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="nome">Nome do Cliente</label>
                                        <p class="form-control-static">{{ $ticket->order->client->nome }}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="cpf">E-mail</label>
                                        <p class="form-control-static">{{ $ticket->order->client->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="status">Nº do Pedido</label>
                                        <p class="form-control-static">{{ $ticket->order->numpedido }}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="telcliente">Título do Ticket</label>
                                        <p class="form-control-static">{{ $ticket->titulo }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="descricao">Conteúdo do Ticket</label>
                                        <p class="form-control-static">{{ $ticket->descricao }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection