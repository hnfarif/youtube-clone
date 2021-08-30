<?php

namespace App\Console\Commands;

// use ProtoneMedia\LaravelFFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Console\Command;

class VideoEncode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video-encode:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Video Encoding...';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $low = (new X264)->setKiloBitrate(500);
        $high = (new X264)->setKiloBitrate(1000);

        FFMpeg::fromDisk('videos-temp')
        ->open('output.mp4')
        ->exportForHLS()
        ->addFormat($low, function($filters){

            $filters->resize(640,480);
        })
        ->addFormat($high, function($filters){

            $filters->resize(1280,720);
        })
        ->onProgress(function($progress){
            $this->info("Progress = {$progress}%");
        })
        ->toDisk('videos-temp')
        ->inFormat(new \FFMpeg\Format\Audio\Aac)
        ->save('/test/file.m3u8');
    }
}
