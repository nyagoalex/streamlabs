<?php

use Illuminate\Support\Facades\Schema;


use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has following columns')
    ->expect(
        fn() => Schema::hasColumns('streams', ['twitch_stream_id', "game_id", "game_name",
            "title", "viewer_count", "started_at", 'tag_ids'])
    )->toBeTrue();
