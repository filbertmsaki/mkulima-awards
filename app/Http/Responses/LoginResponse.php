<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade
        return redirect(url()->previous());
        $user = Auth::user();
        $roles = $user->roles;
        foreach ($roles as $role) {
            $name = $role->name;
            switch ($name) {
                case 'user':
                    auth('web')->logout();
                    break;
                case 'superadministrator':
                    return redirect()->route('admin.dashboard');
                    break;
                case 'administrator':
                    return redirect()->route('admin.dashboard');
                    break;
                default:
                    auth('web')->logout();
                    break;
            }
        }
    }
}
