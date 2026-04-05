<?php

use App\Models\User;

it('redirects guests from home to login', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('login'));
});

it('redirects authenticated users from home to dashboard', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/');

    $response->assertRedirect(route('dashboard'));
});
