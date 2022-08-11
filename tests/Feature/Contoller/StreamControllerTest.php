<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->url = route('home');
});


