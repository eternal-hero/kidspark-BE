<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if (!method_exists($exception, "getStatusCode")) {
            return response()->internalError($exception->getMessage());
        }
        $statusCode = $exception->getStatusCode();
        switch ($statusCode) {
            case 400:
                return response()->invalidRequestParameter($exception->getMessage());
                break;
            case 403:
                return response()->Forbidden($exception->getMessage());
                break;
            case 404:
                return response()->notFound($exception->getMessage());
                break;
            default:
                return response()->internalError($exception->getMessage());
        }
    }
}
