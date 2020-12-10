<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->url() !== route('mail_api')) {
            return parent::render($request, $exception);
        }

        $body = [
            'errors' => [
                [
                    'message' => 'Server Error',
                    'failed' => null,
                    'help' => null,
                ]
            ]
        ];

        $status = 500;

        if ($exception instanceof ValidationException) {
            $status = 400;
            $key = $exception->validator->errors()->keys()[0];
            $body['errors'][0]['failed'] = $key;
            $body['errors'][0]['message'] = $exception->validator->errors()->first($key);
        } elseif (method_exists($exception, 'getStatusCode')) {
            $status = $exception->getStatusCode();
        }

        return new JsonResponse($body, $status);
    }
}
