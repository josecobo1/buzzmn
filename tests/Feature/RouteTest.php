<?php

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

test('route / return 200', function(){
    $response = $this->get('/');

    $response->assertStatus(200);
});