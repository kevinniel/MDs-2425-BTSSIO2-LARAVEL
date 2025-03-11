<?php

use App\Models\Restaurant;
use App\Models\User;

it('retourne la bonne vue pour la route restaurants.index', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Créer des restaurants factices pour le test
    Restaurant::factory()->count(3)->create();

    $response = $this->get(route('restaurants.index'));

    // Vérifier que la réponse est bien une vue
    $response->assertOk();
    $response->assertViewIs('restaurants.index');
    $response->assertViewHas('restaurants');

    // Vérifier que les restaurants sont passés à la vue
    $restaurants = $response->viewData('restaurants');
    expect($restaurants)->toHaveCount(3);
});