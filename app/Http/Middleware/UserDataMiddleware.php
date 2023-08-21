<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
class UserDataMiddleware
{
    public function handle($request, Closure $next)
    {
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        $APIController = new APIController(); // Asegúrate de importar la clase adecuadamente
        $user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

        view()->share('permisos2', $user);

        return $next($request);
    }
}
