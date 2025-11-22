<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\CanonicalizeUsername;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RedirectsIfTwoFactorAuthenticatable;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as BaseController;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Illuminate\Routing\Pipeline;
use Inertia\Inertia;

class AuthenticatedSessionController extends BaseController
{
    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        // Run Fortify’s normal login process first
        $response = $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });

        // Now, the user is definitely authenticated
        /** @var User $user */
        $user = Auth::user();

        if (! $user) {
            // Fallback: if still null, just return normal response
            return $response;
        }

        $redirectTo = $this->getRedirectRoute($user);

        if ($intended = session()->get('url.intended')) {
            if ($user->hasRole([RolesEnum::Admin])) {
                return Inertia::location($redirectTo);
            }
            return redirect()->intended($redirectTo);
        }

        return Inertia::location($redirectTo);
    }

    private function getRedirectRoute(User $user): string
    {
        if ($user->hasRole([RolesEnum::Admin])) {
            return '/admin';
        }
        return '/';
    }
}