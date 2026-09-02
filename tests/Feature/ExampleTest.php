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

test('authenticated users can toggle a habit', function () {
    $user = User::factory()->create();
    $habit = Habit::factory()->for($user)->create();

    $response = $this->actingAs($user)->post('/dashboard/habits/'.$habit->id.'/toggle');

    $response->assertRedirect();
    $this->assertDatabaseHas('habit_logs', [
        'user_id' => $user->id,
        'habit_id' => $habit->id,
    ]);
});
