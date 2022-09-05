<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'http://127.0.0.1:8000/auth/register', 'http://127.0.0.1:8000/auth/login','http://127.0.0.1:8000/auth/logout','http://127.0.0.1:8000/profil'
    ];
}
