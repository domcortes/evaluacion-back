<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;

class SystemController extends Controller
{
    static public function addHeadersAPI($response, $count)
    {
        $response->header('X-Total-Count', $count);
        $response->header('Access-Control-Expose-Headers', 'X-Total-Count');
        $token = csrf_token();
        $response = $response->withCookie(Cookie::make('XSRF-TOKEN', $token, config('session.lifetime')));

        return $response;
    }
}
