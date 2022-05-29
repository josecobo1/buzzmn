<?php

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Request;

test('api call to openweather return 200', function () {
    $response = Http::openweather(['zip' => '08240,es'])->get('/data/2.5/weather');

    $status = $response->getStatusCode();

    $this->assertTrue($status == 200);
});
