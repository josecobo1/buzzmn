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
        // try {

        //     if ($response->clientError()) {
        //         Log::error('Se ha producido un error en la petición error 4**');
        //         Log::error($response);
        //     }

        //     return response()->json($response->json(), 200);
        // } catch (RequestException $exception) {
        //     Log::error('Se ha producido un error 5**');
        //     Log::error($exception);

        //     abort(404, 'No se ha podido realizar la consulta.');
        // }
    }
}
