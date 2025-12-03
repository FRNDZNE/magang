<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Spatie exception
        if ($exception instanceof UnauthorizedException) {
            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak. Anda tidak memiliki role atau permission yang sesuai.');
        }

        // Laravel 403 (middleware role:)
        if ($exception instanceof HttpException && $exception->getStatusCode() === 403) {
            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak. Anda tidak berhak mengakses halaman ini.');
        }

        return parent::render($request, $exception);
    }
}
