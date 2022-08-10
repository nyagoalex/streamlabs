<?php

namespace App\Console\Commands;

use App\Actions\FetchTopStreams;
use App\Models\Stream;
use Illuminate\Console\Command;

class RefreshStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'streams:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the streams table';


    public function handle()
    {
        info("Starting to refresh streams table");

        (new RefreshStreamsTableAction())();

        info("Refreshing streams table ended successfully");
    }
}
