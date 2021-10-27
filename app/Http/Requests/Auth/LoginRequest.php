<?php

namespace App\Http\Requests\Auth;

use App\Events\LockoutEvent;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
            "email" => "required|email",
            "password" => "required|min:8"
        ];
    }

    public function authenticate()
    {
        $this->ensureIsNotRateLimited();
        if (!Auth::attempt($this->only("email", "password"))) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                "modal-message" => __('auth.failed')
            ]);
        }
        RateLimiter::clear($this->throttleKey());
        $this->session()->regenerate();
    }

    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
        event(new LockoutEvent($this->throttleKey()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            "email" => __("auth.throttle", ["seconds" => $seconds, "minutes" => ceil($seconds / 60)])
        ]);
    }

    public function throttleKey()
    {
        return Str::lower($this->input("email") . "|" . $this->ip());
    }
}
