<?php

it('retourne un code 302 pour la page d\'accueil (redirection vers login)', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
});

it('retourne une erreur 404 pour une page inexistante', function () {
    $response = $this->get('/page-inexistante');

    $response->assertStatus(404);
});

it('redirige vers la page de connexion si non authentifié', function () {
    $response = $this->get('/dashboard');

    $response->assertRedirect('/login');
});
