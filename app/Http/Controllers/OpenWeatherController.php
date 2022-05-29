<?php

namespace App\Http\Controllers;

use Error;
use Exception;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenWeatherController extends Controller
{
    public function show(Request $request)
    {

        $params = $request->all();

        return Http::openweather($params)->get('/data/2.5/weather')->throw()->json();
    }
}
