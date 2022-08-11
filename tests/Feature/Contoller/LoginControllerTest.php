<?php

namespace Tests\Feature\Controller;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->url = route('home');
});


it('login page can be render', function () {
    $response = $this->get(route('auth.login'));
    $response->assertStatus(200);
});

it('user can login via login page', function () {
    $response = $this->get(route('auth.twitch'));
    $response->assertStatus(302);
    $this->assertStringContainsString('https://id.twitch.tv/oauth2/authorize', $response->getTargetUrl());
});

it('user can log out when log in', function () {
    $this->be($this->user);
    $this->assertAuthenticated();

    $this->post(route('auth.logout'));
    $this->assertGuest();
});

