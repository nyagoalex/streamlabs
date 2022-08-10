<?php


namespace App\Actions;


use App\Models\Demand;
use App\Models\Stream;

class RefreshStreamsTableAction
{
    public function __invoke()
    {
        $repo = new FetchTopStreams();

        $streams = $repo->getpreparedStreams();

        Stream::insert($streams->shuffle()->all());
    }
}
