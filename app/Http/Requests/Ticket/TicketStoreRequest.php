<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:2048'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
