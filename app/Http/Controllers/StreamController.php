<?php

namespace App\Http\Controllers;

use App\Actions\StreamsFollowedAction;
use App\Actions\StreamTagAction;
use App\Models\Stream;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class StreamController extends Controller
{
    public function index()
    {

        return Inertia::render('Home');
    }

    public function streamPerGame()
    {
       $streams = Stream::query()
           ->select( 'game_name',  DB::raw('count(id) as total'))
       ->groupBy( 'game_name')
           ->orderBy('total', 'DESC')
           ->pluck('total', 'game_name');


       return response($streams);
    }

    public function topGamesByViewerCount()
    {
       $streams = Stream::query()
           ->select( 'game_name',  DB::raw('sum(viewer_count) as total_viewer_count'))
       ->groupBy( 'game_name')
           ->orderBy('total_viewer_count', 'DESC')
           ->pluck('total_viewer_count', 'game_name');


       return response($streams);
    }

    public function medianViewerCount()
    {
       $streams = Stream::query()->orderBy('viewer_count')->get('viewer_count');

       return response($streams->median('viewer_count'));
    }

    public function topStreamsByViewerCount()
    {
        $sort_direction = request('sort_direction', 'DESC');

       $streams = Stream::query()
           ->orderBy('viewer_count', 'DESC')
           ->limit(100)
           ->get(['viewer_count', 'game_name']);

        $streams = strtoupper($sort_direction) === 'ASC'? $streams->sort() : $streams;
       return response($streams);
    }

    public function numberOfStreamsByStartTime()
    {
       $streams = Stream::query()
           ->select(DB::raw("sum(viewer_count) as total_viewer_count ,date_format(started_at,'%Y-%m-%d %H') as start_time"))
           ->groupBy( 'start_time')
           ->orderBy('start_time', 'DESC')
           ->pluck('total_viewer_count', 'start_time');

       return response($streams);
    }

    public function streamsFollowedByUser()
    {
        $repo = new StreamsFollowedAction();

        $followed_stream_ids = $repo->getStreamIds();

       $streams = Stream::query()
           ->whereIntegerInRaw('twitch_stream_id',  $followed_stream_ids)
           ->pluck('title');

       return response($streams);
    }

    public function viewersNeededForLeastFollowed()
    {
        $min_viewer_count = Stream::min('viewer_count');

        $repo = new StreamsFollowedAction();

        $least_viewed = $repo->leastViewedStream();

        if ($least_viewed === null) {
            return response([]);
        }

        $data = [
            "title" => $least_viewed['title'],
            "followed_viewer_count" => $least_viewed['viewer_count'],
            "min_viewer_count" => $min_viewer_count,
            "needed" => max($min_viewer_count - $least_viewed['viewer_count'], 0),
        ];

       return response($data);
    }


    public function sharedTags()
    {
        $repo = new StreamsFollowedAction();

        $followed_stream_tags = $repo->getTags();

        if ($followed_stream_tags->isEmpty()) {
            return response([]);
        }

        $stream_tags = Stream::pluck('tag_ids')->flatten()->unique()->values();

        $intersect = $stream_tags->intersect($followed_stream_tags);

        $tags = (new StreamTagAction())->get($intersect);

        return response($tags->pluck('localization_descriptions.en-us'));
    }
}
