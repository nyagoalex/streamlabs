<?php

namespace App\Repository\Eloquent;

use App\Actions\StreamsFollowedAction;
use App\Actions\StreamTagAction;
use App\Models\BulkFile;
use App\Models\Stream;
use App\Repository\StatRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StatRepository extends BaseRepository implements StatRepositoryInterface
{
    public function streamPerGame(): LengthAwarePaginator
    {
        return Stream::query()
            ->select('game_name', DB::raw('count(id) as total'))
            ->groupBy('game_name')
            ->orderBy('total', 'DESC')
            ->paginate(10);

    }

    public function topGamesByViewerCount(): LengthAwarePaginator
    {
        return Stream::query()
            ->select('game_name', DB::raw('sum(viewer_count) as total_viewer_count'))
            ->groupBy('game_name')
            ->orderBy('total_viewer_count', 'DESC')
            ->paginate(10);

    }


    public function medianViewerCount(): float|int|null
    {
        $streams = Stream::query()->orderBy('viewer_count')->get('viewer_count');

        return $streams->median('viewer_count');
    }

    public function topStreamsByViewerCount(): Collection|array
    {
        $sort_direction = request('sort_direction', 'DESC');

        $streams = Stream::query()
            ->orderBy('viewer_count', 'DESC')
            ->limit(100)
            ->get(['viewer_count', 'title']);

        return strtoupper($sort_direction) === 'ASC' ? $streams->sort() : $streams;

    }

    public function numberOfStreamsByStartTime(): LengthAwarePaginator
    {
        return Stream::query()
            ->select(DB::raw("count(id) as streams_count ,date_format(started_at,'%Y-%m-%d %H') as start_time"))
            ->groupBy('start_time')
            ->orderBy('start_time', 'DESC')
            ->paginate(10);

    }


    public function streamsFollowedByUser(): Collection|array
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


    public function sharedTags(): array|\Illuminate\Support\Collection
    {
        $repo = new StreamsFollowedAction();

        $followed_stream_tags = $repo->getTags();

        if ($followed_stream_tags->isEmpty()) {
            return [];
        }

        $stream_tags = Stream::pluck('tag_ids')->flatten()->unique()->values();

        $intersect = $stream_tags->intersect($followed_stream_tags);

        if ($intersect->isEmpty()) {
            return [];
        }

        $tags = (new StreamTagAction())->get($intersect);

        return $tags->pluck('localization_descriptions.en-us');
    }
}
