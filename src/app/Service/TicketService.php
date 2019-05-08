<?php

namespace App\Service;

use App\Filter\Ticket\TicketFilter;
use App\Order\Ticket\Conditions\Id;
use App\Order\Ticket\TicketOrder;
use App\Repository\ClientRepository;
use App\Repository\OrderRepository;
use App\Repository\TicketRepository;
use App\Utilities\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketService
{
    /** @var TicketRepository $ticketRepository */
    protected $ticketRepository;

    /**
     * TicketService constructor.
     * @param TicketRepository $ticketRepository
     */
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }


    /**
     * Método para listar todos os tickets com paginação.
     * @param Request $request
     * @return mixed
     */
    public function all(Request $request)
    {
        if (!$request->has('sort')) {
            $this->ticketRepository->pushOrder(new Id('desc'));
        }
        TicketOrder::apply($this->ticketRepository, $request);
        TicketFilter::apply($this->ticketRepository, $request);
        return $this->ticketRepository->paginate(5);
    }

    /**
     * Método para listar todos os tickets com paginação.
     * @param Request $request
     * @return mixed
     */
    public function allTickets(Request $request)
    {
        if (!$request->has('sort')) {
            $this->ticketRepository->pushOrder(new Id('desc'));
        }
        TicketOrder::apply($this->ticketRepository, $request);
        TicketFilter::apply($this->ticketRepository, $request);
        return $this->ticketRepository->allTickets();
    }

    /**
     * Método para buscar um ticket.
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->ticketRepository->find($id);
//        return $this->ticketRepository->getTicket($id);
    }

    /**
     * Método para criar uma nova despesa.
     * @param $data
     * @return array
     */
    public function create($data)
    {
        unset($data['_token']);
        $clientRepository = app()->make(ClientRepository::class);
        $orderRepository = app()->make(OrderRepository::class);
        $client = $clientRepository->findBy('email', $data['email']);
        $verifyOrder = $orderRepository->findBy('numpedido', $data['numpedido']);

        DB::beginTransaction();
        try {
            if (empty($client)) {
                $client = $clientRepository->create([
                    'nome' => $data['nome'],
                    'email' => $data['email']
                ]);
            }

            if(!empty($client) && !empty($verifyOrder) && $client['id'] != $verifyOrder['idcliente']){
                DB::rollback();
                return ['status' => Status::ERROR, 'message' => 'Não foi possível realizar o cadastro, o nº do pedido já está em uso.'];
            } else if (!empty($client) && !empty($verifyOrder) && $client['id'] == $verifyOrder['idcliente']){
                $response = $this->ticketRepository->update([
                    'titulo' => $data['titulo'],
                    'descricao' => $data['descricao']
                ], $verifyOrder['idticket']);

                if ($response == false) {
                    DB::rollback();
                    return [
                        'status' => Status::ERROR,
                        'message' => 'Ocorreu um erro. Tente novamente e caso o erro persista, contate o administrador do sistema'
                    ];
                }

                $ticket = $this->ticketRepository->find($verifyOrder['idticket']);
                $order = $orderRepository->findBy('idticket', $ticket['id']);
            }else{
                $ticket = $this->ticketRepository->create([
                    'titulo' => $data['titulo'],
                    'descricao' => $data['descricao']
                ]);

                $order = $orderRepository->create([
                    'numpedido' => $data['numpedido'],
                    'idcliente' => $client['id'],
                    'idticket' => $ticket['id']
                ]);
            }

            if (!$order->id) {
                DB::rollback();
                return ['status' => Status::ERROR, 'message' => 'Ocorreu um erro. Tente novamente e caso o erro persista, contate o administrador do sistema'];
            }

            DB::commit();
            return [
                'status' => Status::SUCCESS,
                'message' => 'Ticket cadastrado com sucesso'
            ];

        } catch (\Exception $e) {
            DB::rollback();
            return [
                'status' => Status::ERROR,
                'message' => 'Ocorreu um erro. Tente novamente e caso o erro persista, contate o administrador do sistema'
            ];
        }
    }
}
