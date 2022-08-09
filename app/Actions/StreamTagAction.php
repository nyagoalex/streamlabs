<?php


namespace App\Actions;


use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StreamTagAction
{
    public function get(Collection $tagIds): Collection
    {
        $tag_ids = 'tag_id='.$tagIds->implode('&tag_id=');

        $cursor = null;

        $tags = collect();

        for ($x = 1; $x <= 10; $x++) {

            $result = $this->getTags($tag_ids, $cursor);

            $tags->push(...$result['data']);

            $cursor = $result['pagination']['cursor'] ?? null;

            if (!$cursor) {
                break;
            }
        }

        return $tags;
    }

    private function getTags(string $tag_ids, ?string $cursor): array
    {
        $user = Auth::user();

        $param = $tag_ids.'&first=100';
        if ($cursor) {
            $param = $tag_ids.'&after='.$cursor;
        }

        $response = Http::withToken($user->token)
            ->withHeaders(['Client-Id' => config('services.twitch.client_id')])
            ->get('https://api.twitch.tv/helix/tags/streams?'.$param);


        if ($response->failed()) {
            $response->throw();
        }
        return $response->json();
    }
}
