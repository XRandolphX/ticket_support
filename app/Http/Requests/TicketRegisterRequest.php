<?php

namespace App\Http\Requests;

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
        return false;
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
            'user_id' => 'required',
            'ticket_status_id' => 'required',
            'ticket_priority_id' => 'required',
        ];
    }
}
