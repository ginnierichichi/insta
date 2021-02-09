<?php


namespace App\Actions\Fortify;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illumiate\Routing\Redirector;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginResponse
 * @package App\Actions\Fortify
 */
class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect(route('profile', ['user' => auth()->user()->username]));
    }
}
