<?php
namespace App\Domains\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the login request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|string',
        ];
    }
}