<?php

namespace App\Repository;

interface StatRepositoryInterface
{
    public function streamPerGame();

    public function topGamesByViewerCount();

    public function medianViewerCount();

    public function topStreamsByViewerCount();

    public function numberOfStreamsByStartTime();

    public function streamsFollowedByUser();

    public function viewersNeededForLeastFollowed();

    public function sharedTags();
}
