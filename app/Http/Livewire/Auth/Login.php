<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    public function authenticate()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        }
        if (!auth()->user()->status) {
            $this->addError('email', 'your account not active');
            auth()->logout();
            return;
        }

        return redirect()->route('home');//intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
