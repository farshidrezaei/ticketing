<?php

namespace App\Contracts;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

interface TicketRepositoryInterface
{

    public function getTickets(?int $page = null, ?int $perPage = null): LengthAwarePaginator|array;

    public function storeTicket(string $title, string $message): Ticket;

    public function updateTicket(Ticket $ticket, TicketStatusEnum $status): Ticket;

}