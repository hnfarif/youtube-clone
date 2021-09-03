<?php

namespace App\Jobs;

use App\Models\Video;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $video;
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $destination = '/' . $this->video->uid . '/' . $this->video->uid . '.m3u8';
        $low = (new X264)->setKiloBitrate(500);
        $high = (new X264)->setKiloBitrate(1000);

        FFMpeg::fromDisk('videos-temp')
        ->open($this->video->path)
        ->exportForHLS()
        ->addFormat($low, function($filters){

            $filters->resize(640,480);
        })
        ->addFormat($high, function($filters){

            $filters->resize(1280,720);
        })
        ->onProgress(function($progress){
            $this->video->update([
                'processing_percentage' => $progress
            ]);
        })
        ->toDisk('videos')
        ->inFormat(new \FFMpeg\Format\Audio\Aac)
        ->save($destination);

        $this->video->update([
            'processed' => true,
            'processed_file' => $this->video->uid. '.m3u8'
        ]);
    }
}
