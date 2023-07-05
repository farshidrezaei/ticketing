<?php

namespace App\Repositories;

use App\Contracts\TicketRepositoryInterface;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TicketRepository implements TicketRepositoryInterface
{
    public function __construct(private readonly Ticket $model)
    {
    }

    public function getTickets(?int $page = null, ?int $perPage = null): LengthAwarePaginator|array
    {
        return $this->model->paginate(perPage: $perPage, page: $page);
    }

    /**
     * @throws Exception
     */
    public function storeTicket(string $title, string $message): Ticket
    {
        try {
            DB::beginTransaction();

            $ticket = Auth::user()->tickets()
                ->create([
                    'title' => $title,
                    'status' => TicketStatusEnum::PENDING
                ]);

            $ticket->messages()->create(['message' => $message]);

            DB::commit();

            return $ticket;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical('ticket store failed.', [
                'user_id' => Auth::id(),
                'exception_message'=>$exception->getMessage(),
            ]);

            throw $exception;
        }
    }

    public function updateTicket(Ticket $ticket, TicketStatusEnum $status): Ticket
    {
        $ticket->update(['status' => $status]);

        return $ticket;
    }
}