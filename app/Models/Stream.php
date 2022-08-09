<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;

    protected $fillable = ['twitch_stream_id', "game_id", "game_name",
        "title", "viewer_count", "started_at", 'tag_ids'];

    protected $casts=[
        'tag_ids' => 'array'
    ];
}
