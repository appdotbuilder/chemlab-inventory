<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'student_id' => '1234567890',
        'role' => 'student',
        'department' => 'Chemical Engineering',
        'phone' => '+62 812 3456 7890',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    // User should not be authenticated due to pending approval
    $this->assertGuest();
    $response->assertRedirect(route('login'));
    $response->assertSessionHas('success');
    
    // User should be created with pending status
    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'status' => 'pending'
    ]);
});
