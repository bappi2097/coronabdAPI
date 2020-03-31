<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        $data = [
            'status' => "wrong route",
            'route_details' => [
                0 => route('bn-bangladesh'),
                1 => route('en-bangladesh'),
                2 => route('bn-world'),
                3 => route('en-world'),
                4 => route('bn-countries'),
                5 => route('en-countries'),
                6 => route('bn-districts'),
                7 => route('en-districts'),
                8 => route('bn-country-name', ['name' => 'CountryName']),
                9 => route('en-country-name', ['name' => 'CountryName']),
                10 => route('bn-district-name', ['name' => 'DistrictName']),
                10 => route('en-district-name', ['name' => 'DistrictName']),
            ],
            'contact_info' => [
                "facebook" => "https://web.facebook.com/bappi.saha.75033",
                "mail" => "bappi35-2097@diu.edu.bd",
            ],
            'visit' => "https://coronabd.xyz/",
        ];

        if ($this->isHttpException($exception)) {
            $code = $exception->getStatusCode();
            if ($code == '404') {
                return response()->json($data);
            }
        }
        return parent::render($request, $exception);
    }
}
