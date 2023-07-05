<?php

namespace App\Http\Requests\Ticket;

use App\Enums\TicketStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(TicketStatusEnum::class)],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
