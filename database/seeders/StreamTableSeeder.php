<?php

namespace Database\Seeders;

use App\Actions\RefreshStreamsTableAction;
use Illuminate\Database\Seeder;

class StreamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new RefreshStreamsTableAction())();
    }

}
