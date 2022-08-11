<?php

use Illuminate\Support\Facades\Schema;


use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has following columns')
    ->expect(
        fn() => Schema::hasColumns('users', ['name','username','twitch_id','email','token', 'profile_image_url'])
    )->toBeTrue();
