<?php

it('redirige les utilisateurs non authentifiés', function () {
    $response = $this->get('/dashboard');

    $response->assertRedirect('/login');
});
