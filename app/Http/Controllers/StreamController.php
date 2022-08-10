<?php

namespace App\Http\Controllers;

use App\Actions\StreamsFollowedAction;
use App\Actions\StreamTagAction;
use App\Models\Stream;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StreamController extends Controller
{
    public function index()
    {

        return Inertia::render('Home', [
            'streamPerGame' => $this->streamPerGame(),
            'topGamesByViewerCount' => $this->topGamesByViewerCount(),
            'topStreamsByViewerCount' => $this->topStreamsByViewerCount(),
            'numberOfStreamsByStartTime' => $this->numberOfStreamsByStartTime(),
            'streamsFollowedByUser' => $this->streamsFollowedByUser(),
            'medianViewerCount' => $this->medianViewerCount(),
            'viewersNeededForLeastFollowed' => $this->viewersNeededForLeastFollowed(),
            'sharedTags' => $this->sharedTags(),
        ]);
    }

    public function streamPerGame()
    {
        return Stream::query()
            ->select('game_name', DB::raw('count(id) as total'))
            ->groupBy('game_name')
            ->orderBy('total', 'DESC')
            ->paginate(10);

    }

    public function topGamesByViewerCount()
    {
        return Stream::query()
            ->select('game_name', DB::raw('sum(viewer_count) as total_viewer_count'))
            ->groupBy('game_name')
            ->orderBy('total_viewer_count', 'DESC')
            ->paginate(10);

    }

    public function medianViewerCount()
    {
        $streams = Stream::query()->orderBy('viewer_count')->get('viewer_count');

        return $streams->median('viewer_count');
    }

    public function topStreamsByViewerCount()
    {
        $sort_direction = request('sort_direction', 'DESC');

        $streams = Stream::query()
            ->orderBy('viewer_count', 'DESC')
            ->limit(100)
            ->get(['viewer_count', 'title']);

        return strtoupper($sort_direction) === 'ASC' ? $streams->sort() : $streams;

    }

    public function numberOfStreamsByStartTime()
    {
        return Stream::query()
            ->select(DB::raw("count(id) as streams_count ,date_format(started_at,'%Y-%m-%d %H') as start_time"))
            ->groupBy('start_time')
            ->orderBy('start_time', 'DESC')
            ->paginate(10);

    }

    public function streamsFollowedByUser()
    {
        $repo = new StreamsFollowedAction();

        $followed_stream_ids = $repo->getStreamIds();

        return Stream::query()
            ->whereIntegerInRaw('twitch_stream_id', $followed_stream_ids)
            ->get('title');
    }

    public function viewersNeededForLeastFollowed()
    {
        $min_viewer_count = Stream::min('viewer_count');

        $repo = new StreamsFollowedAction();

        $least_viewed = $repo->leastViewedStream();

        if ($least_viewed === null) {
            return 0;
        }

        return max($min_viewer_count - $least_viewed['viewer_count'], 0);
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

        return $tags->pluck('localization_descriptions.en-us');
    }
}
