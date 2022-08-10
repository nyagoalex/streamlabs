<?php

namespace App\Http\Controllers;

use App\Repository\StatRepositoryInterface;
use Inertia\Inertia;
use Inertia\Response;

class StreamController extends Controller
{
    private StatRepositoryInterface $repo;

    public function __construct(StatRepositoryInterface $statRepository)
    {
        $this->repo = $statRepository;
    }

    public function index(): Response
    {

        return Inertia::render('Home', [
            'streamPerGame' => $this->repo->streamPerGame(),
            'topGamesByViewerCount' => $this->repo->topGamesByViewerCount(),
            'topStreamsByViewerCount' => $this->repo->topStreamsByViewerCount(),
            'numberOfStreamsByStartTime' => $this->repo->numberOfStreamsByStartTime(),
            'streamsFollowedByUser' => $this->repo->streamsFollowedByUser(),
            'medianViewerCount' => $this->repo->medianViewerCount(),
            'viewersNeededForLeastFollowed' => $this->repo->viewersNeededForLeastFollowed(),
            'sharedTags' => $this->repo->sharedTags(),
        ]);
    }


}
