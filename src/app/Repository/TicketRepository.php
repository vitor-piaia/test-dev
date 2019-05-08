<?php

namespace App\Repository;

class TicketRepository extends AbstractRepository
{
    public function model()
    {
        return 'App\Models\Ticket';
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allTickets()
    {
        $this->applyCriteria();
        $this->applyOrder();
        return $this->model
            ->select('ticket.*', 'pedido.numpedido', 'cliente.email')
            ->join('pedido', 'ticket.id', '=', 'pedido.idticket')
            ->join('cliente', 'pedido.idcliente', '=', 'cliente.id')
            ->paginate(5);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getTicket($id)
    {
        return $this->model
            ->select('ticket.*', 'pedido.numpedido', 'cliente.nome', 'cliente.email')
            ->join('pedido', 'ticket.id', '=', 'pedido.idticket')
            ->join('cliente', 'pedido.idcliente', '=', 'cliente.id')
            ->where('ticket.id', '=', $id)
            ->first();
    }
}