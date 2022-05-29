<?php

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

test('.env file has api key', function () {
    $this->assertTrue(!is_null(env('APPID')));
});

test('.env has openweather api', function () {
    $this->assertTrue(!is_null(env('OPENWEATHER_URL')));
});
