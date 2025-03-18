<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'user',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'approved' => false, 
    ]);



    $response->assertRedirect(route('pending-approval'));
});
