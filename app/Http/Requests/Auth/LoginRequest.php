<?php

namespace App\Http\Requests\Auth;

use Auth;
use Composer\Command\ExecCommand;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Log;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "email" => "required|email|unique:users",
            "password" => "required|min:8"
        ];
    }

    public function authenticate()
    {
        if (!Auth::attempt($this->only("email", "password"))) {
            throw ValidationException::withMessages([
                "modal-message" => __('auth.failed')
            ]);
        }
        $this->session()->regenerate();
    }
}
