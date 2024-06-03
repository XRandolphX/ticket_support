<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // Cualquier usuario puede hacer esta solicitud "true".
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    // Reglas de validación.
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    // Recupera las credenciales de la solicitud del usuario y retorna según las credenciales.
    public function getCredentials()
    {
        $username = $this->get('username');

        if ($this->isEmail($username)) {
            return ['email' => $username, 'password' => $this->get('password')];
        }
        return $this->only('username', 'password');
    }
    // Verifica si el valor dado es un correo electrónico.
    public function isEmail($value)
    {
        $factory = $this->container->make(ValidationFactory::class);
        return !$factory->make(['username' => $value], ['username' => 'email'])->fails();
    }
}
