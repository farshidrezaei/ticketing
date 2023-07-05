<?php

namespace App\Http\Controllers\API\V1\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketIndexRequest;
use App\Http\Requests\Ticket\TicketStoreRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Exception;

class TicketController extends Controller
{
    public function __construct(private readonly TicketRepository $ticketRepository)
    {
    }

    public function index(TicketIndexRequest $request)
    {
        $tickets = $this->ticketRepository
            ->getTickets($request->validated('page'), $request->validated('per_page'));

        return TicketResource::collection($tickets);
    }

    /**
     * @throws Exception
     */
    public function store(TicketStoreRequest $request)
    {
        $ticket = $this->ticketRepository
            ->storeTicket($request->validated('title'), $request->validated('message'));

        return TicketResource::make($ticket);
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        $ticket = $this->ticketRepository
            ->updateTicket($ticket, $request->validated('status'));

        return TicketResource::make($ticket);
    }
}
