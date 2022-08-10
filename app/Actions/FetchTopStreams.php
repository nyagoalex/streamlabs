<?php


namespace App\Actions;


use App\Models\Stream;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class FetchTopStreams
{
    private Collection $streams;

    public function __construct()
    {
        $token = $this->getToken();

        $cursor = null;

        $this->streams = collect();

        for ($x = 1; $x <= 10; $x++) {

            $result = $this->fetchStreams($token, $cursor);

            $cursor = $result['pagination']['cursor'];

            $this->streams->push(...$result['data']);
        }
    }

    public function getStreams(): Collection
    {
        return $this->streams;
    }

    public function getpreparedStreams(): Collection
    {
        $streams =  $this->streams;

        $streams->transform(fn($stream) => [
            "twitch_stream_id" => $stream["id"],
            "game_id" => $stream["game_id"],
            "game_name" => $stream["game_name"],
            "title" => $stream["title"],
            "viewer_count" => $stream["viewer_count"],
            "started_at" => Carbon::parse($stream["started_at"]),
            "tag_ids" => json_encode($stream["tag_ids"], JSON_THROW_ON_ERROR | JSON_ERROR_NONE),
        ]);

        return $streams;
    }

    private function getToken(): string
    {
        $body = [
            'client_id' => config('services.twitch.client_id'),
            'client_secret' => config('services.twitch.client_secret'),
            'grant_type' => 'client_credentials',
        ];

        $response = Http::acceptJson()
            ->asForm()
            ->retry(3, 100)
            ->post('https://id.twitch.tv/oauth2/token', $body);

        if ($response->failed()) {
            $response->throw();
        }

        return ($response->json())['access_token'];
    }

    private function fetchStreams($token, ?string $cursor): bool|array
    {
        $param = ['first' => 100];
        if ($cursor) {
            $param['after'] = $cursor;
        }

        $response = Http::withToken($token)
            ->withHeaders(['Client-Id' => config('services.twitch.client_id')])
            ->get('https://api.twitch.tv/helix/streams', $param);


        if ($response->failed()) {
            $response->throw();
        }
        return $response->json();
    }
}
