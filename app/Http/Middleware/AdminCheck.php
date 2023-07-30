<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    public function handle(Request $request): ?string
    {
        dd($request);
        //return Auth::user() !== null && Auth::user()->profile === 'admin' ? null : route('login');
    }
}
