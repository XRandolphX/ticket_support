<?php

namespace App\Http\Requests;

use App\Models\TicketModel;
use Illuminate\Foundation\Http\FormRequest;

class TicketRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return $this->user()->can('create', TicketModel::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'subject' => 'required',
            'description' => 'required',
            'ticket_priority_id' => 'required|exists:ticket_priority,id',
        ];
    }
}
