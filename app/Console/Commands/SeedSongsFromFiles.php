<?php

namespace App\Console\Commands;

use App\Models\Track;
use Illuminate\Console\Command;

class SeedSongsFromFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracks:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //find all mp3 files in the music directory
        $dir = public_path() . '/music/';
        $files = scandir($dir);

        //loop through the files and add them to the database
        $count = 0;
        foreach ($files as $file) {
            if (substr($file, -4) == '.mp3') {
                //if the file is an mp3, and doesn't already exist in the database, add it to the database
                $name = ucfirst(substr($file, 0, -4));
                $track = Track::firstOrCreate(['name' => $name, 'file' => $file, 'album_id' => 1]);
                $this->info('processing '. $name);
                $track->save();
                $count++;
            }
        }
        $this->info('Added ' . $count . ' tracks to the database.');

    }
}
