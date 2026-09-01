<?php

use App\Models\Habit;
use App\Models\User;

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('authenticated users can access the habits settings page', function () {
    $user = User::factory()->create();
    Habit::factory()->for($user)->create();

    $response = $this->actingAs($user)->get('/dashboard/habits/configurar');

    $response->assertOk();
    $response->assertSee('Configurar Hábitos');
});
