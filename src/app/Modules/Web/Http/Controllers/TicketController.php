<?php

namespace App\Modules\Web\Http\Controllers;

use App\Modules\Web\Http\Requests\TicketRequest;
use App\Service\TicketService;
use App\Utilities\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    /** @var TicketService $ticketService */
    protected $ticketService;

    /**
     * TicketController constructor.
     * @param TicketService $ticketService
     */
    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * Lista de Ticket
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tickets = $this->ticketService->allTickets($request);

        return view('web::ticket.index', compact('tickets'));
    }

    /**
     * Detalhe do Ticket
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $ticket = $this->ticketService->find($id);

        return view('web::ticket.show', compact('ticket'));
    }

    /**
     * View para adicionar um Ticket
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('web::ticket.create');
    }

    /**
     * Adiciona um Ticket
     *
     * @param TicketRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TicketRequest $request)
    {
        $response = $this->ticketService->create($request->all());
        if($response['status'] == Status::SUCCESS){
            return redirect()->back()->with('message', $response['message'])->with('status', $response['status']);
        }
        return redirect()->back()->with('message', $response['message'])->withInput($request->all());
    }
}
