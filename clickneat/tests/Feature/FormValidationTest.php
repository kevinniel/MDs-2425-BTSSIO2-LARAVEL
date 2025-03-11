<?php

it('rejette un utilisateur sans email', function () {
    $response = $this->postJson('/register', [
        'name' => 'John Doe',
        'password' => 'password'
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});
