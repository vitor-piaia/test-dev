@extends('web::layout.app')

@section('title', 'Ticket')

@section('styles')
    <link rel="stylesheet" href="{!! asset('css/animate.css') !!}">
    <link rel="stylesheet" href="{!! asset('libs/bootstrap-datepicker/bootstrap-datepicker.css') !!}">
    <link rel="stylesheet" href="{!! asset('libs/clockpicker/bootstrap-clockpicker.css') !!}">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-xs-12">
            <div class="d--flex j--space-between ai--center">
                <h2>Tickets</h2>
                <div>
                    <a href="{{ route('web.ticket.create') }}" class="btn btn-primary">Adicionar</a>
                </div>
            </div>

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-content">
                <div class="table-responsive">
                    <div class="m-b-md">
                        <div class="table-actions">
                            <div class="table-actions__text">
                                @if(request('numpedido') || request('email'))
                                    <strong class="upper">Filtros:</strong>
                                    {!!
                                        buildFilter([
                                            ['check' => request('numpedido'),   'label' => 'Número',    'value' => request('numpedido')],
                                            ['check' => request('email'),       'label' => 'Pago',      'value' => request('email')]
                                        ])
                                    !!}
                                @endif
                            </div>
                            <div class="table-actions__buttons">
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-filter">Filtrar&nbsp;<i class="fa fa-fw fa-filter"></i></a>
                                @if(request('numpedido') || request('email'))
                                    <a class="btn btn-danger btn-primary-action" href="{{ request()->url() }}">
                                        <i class="fa fa-minus" aria-hidden="true"></i> Limpar
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <th>Número do Ticket</th>
                        <th>Nº do Pedido</th>
                        <th>Título do Pedido</th>
                        <th>E-mail do Cliente</th>
                        <th>Data de Criação do Ticket</th>
                        </thead>
                        <tbody>
                            @if(count($tickets) > 0)
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td><a href="{{ route('web.ticket.show', encrypt_url($ticket->id)) }}">{{ $ticket->id }}</a></td>
                                        <td>{{ $ticket->numpedido }}</td>
                                        <td>{{ $ticket->titulo }}</td>
                                        <td>{{ $ticket->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><div class="text-center">Não existem resultados para serem exibidos</div></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- paginacao -->
                @include('partial.pagination', ['paginator' => $tickets])
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal inmodal" id="modal-filter" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content animated fadeInDown">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                    <i class="fa fa-filter modal-icon"></i>
                    <h4 class="modal-title">Filtrar</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="numpedido">Nº do Pedido</label>
                                    <input type="text" name="numpedido" id="numpedido" class="form-control" maxlength="8" placeholder="Número" value="{{ request('numpedido') }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-control" maxlength="255" placeholder="E-mail" value="{{ request('email') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar<i class="fa fa-fw fa-times"></i></button>
                        <button type="button" class="btn btn-success submit-form">Aplicar<i class="fa fa-fw fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection