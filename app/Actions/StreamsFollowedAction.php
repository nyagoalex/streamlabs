<?php


namespace App\Actions;


use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StreamsFollowedAction
{
    private Collection $streams;

    public function __construct()
    {
        $cursor = null;

        $this->streams = collect();

        for ($x = 1; $x <= 10; $x++) {

            $result = $this->fetchStreams($cursor);

            $this->streams->push(...$result['data']);

            $cursor = $result['pagination']['cursor'] ?? null;

            if (!$cursor) {
                break;
            }
        }

    }

    public function getStreams(): Collection
    {
        return $this->streams;
    }

    public function getStreamIds(): Collection
    {
        return $this->streams->pluck('id');
    }

    public function leastViewedStream(): Array | null
    {
        return $this->streams->sortBy('viewer_count')->first();
    }

    public function getTags(): Collection
    {
        return $this->streams->pluck('tag_ids')->flatten()->unique()->values();
    }

    private function fetchStreams(?string $cursor): array
    {
        $user = Auth::user();

        $param = ['first' => 100, 'user_id' => $user->twitch_id];
        if ($cursor) {
            $param['after'] = $cursor;
        }

        $response = Http::withToken($user->token)
            ->withHeaders(['Client-Id' => config('services.twitch.client_id')])
            ->get('https://api.twitch.tv/helix/streams/followed', $param);


        if ($response->failed()) {
            $response->throw();
        }
        return $response->json();
    }


}
