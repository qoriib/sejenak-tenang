<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        $user = request()->user(); 
        
        if ($user && $user->isAdmin()) {
            return '/admin/dashboard';
        } elseif ($user && $user->isPsychologist()) {
            return '/psychologist/dashboard';
        } else {
            return '/dashboard';
        }
    }
}