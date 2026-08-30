<?php

namespace App\Jobs;

use FFMpeg;
use FFMpeg\Format\Video\X264;
use App\Helper;
use App\Models\User;
use App\Models\Products;
use App\Models\MediaProducts;
use App\Models\AdminSettings;
use App\Models\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\File;

class EncodeVideoShop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MediaProducts $video)
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
      // Admin Settings
      $settings = AdminSettings::first();
      //$product = Products::whereId($this->video->products_id)->first();
      $product = Products::findOrFail($this->video->products_id);

      // Paths
      $disk = 'default';
      $path = 'temp/';
      $videoPathDisk = $path.$this->video->name;
      $videoPathDiskMp4 = $this->video->id.str_random(20).uniqid().now()->timestamp.'-converted.mp4';
      $urlWatermark = ucfirst(Helper::urlToDomain(url('/'))).'/'.$product->user()->username;
      $font = public_path('webfonts/arial.TTF');

      // Create Thumbnail Video
        try {
          $videoPoster = str_random(20).uniqid().now()->timestamp.'-poster.jpg';

          $ffmpeg = FFMpeg::fromDisk($disk)
          ->open($videoPathDisk)
            ->getFrameFromSeconds(1)
            ->export()
          ->toDisk($disk);

          $ffmpeg->save($path.$videoPoster);

          // Clean
          FFMpeg::cleanupTemporaryFiles();

        } catch (\Exception $e) {
          $videoPoster = null;
        }

      // Create a video format...
      $format = new X264();
      $format->setAudioCodec('aac');
      $format->setVideoCodec('libx264');
      $format->setKiloBitrate(0);

      try {
        // open the uploaded video from the right disk...
        if ($settings->watermark_on_videos == 'on') {
          $ffmpeg = FFMpeg::fromDisk($disk)
              ->open($videoPathDisk)
              ->addFilter(['-strict', -2])
              ->addFilter(['-filter_complex', '[0:v]scale=ih*16/9:-1,boxblur=luma_radius=min(h\,w)/20:luma_power=1:chroma_radius=min(cw\,ch)/20:chroma_power=1[bg]'])
              ->addFilter(['-filter_complex', '[bg][0:v]overlay=(W-w)/2:(H-h)/2,crop=h=iw*9/16'])
              ->addFilter(function ($filters) use ($urlWatermark, $font) {
                  $filters->custom("drawtext=text=$urlWatermark:fontfile=$font:x=W-tw-15:y=H-th-15:fontsize=30:fontcolor=white");
                })
              ->export()
              ->toDisk($disk)
              ->inFormat($format);

            $ffmpeg->save($path.$videoPathDiskMp4);

        } else {
          $ffmpeg = FFMpeg::fromDisk($disk)
              ->open($videoPathDisk)
              ->addFilter(['-strict', -2])
              ->export()
              ->toDisk($disk)
              ->inFormat($format);

            $ffmpeg->save($path.$videoPathDiskMp4);
        }
        
        /*$duration = $ffmpeg
           ->streams($videoPathDiskMp4)
           ->videos()                   
           ->first()                  
           ->get('duration');*/

        // Clean
        FFMpeg::cleanupTemporaryFiles();

        // Delete old video
        Storage::disk('default')->delete($videoPathDisk);

          // Update name video on Media table
          MediaProducts::whereId($this->video->id)->update([
              'name' => $videoPathDiskMp4,
              'video_poster' => $videoPoster ?? null,
              'status' => 'active'
          ]);


              Notifications::send($product->user()->id, $product->user()->id, 17, $this->video->products_id);

              // Move Video File to Storage
              $this->moveFileStorage($videoPathDiskMp4);

              // Move Video Poster to Storage
              if ($videoPoster) {
                $this->moveFileStorage($videoPoster);
              }

      } catch (\Exception $e) {

        // Update date the post and status
        // Update name video on Media table
        
          $post = MediaProducts::whereId($this->video->id)->update([
              'name' => $videoPathDiskMp4,
              'video_poster' => $videoPoster ?? null,
              'status' => 'active'
          ]);
            if ($post) {
          // Notify to user - destination, author, type, target
          Notifications::send($product->user()->id, $product->user()->id, 17, $this->video->products_id);

          // Move Video File to Storage
          $this->moveFileStorage($videoPathDiskMp4);

          // Move Video Poster to Storage
          if ($videoPoster) {
            $this->moveFileStorage($videoPoster);
          }
            }
      }

    }// End Handle

    /**
       * Move file to Storage
       *
       * @return void
       */
    protected function moveFileStorage($file)
    {
      $disk = env('FILESYSTEM_DRIVER');
      $path = config('path.shop');
      $localFile = public_path('temp/'.$file);

      // Move the file...
      Storage::disk($disk)->putFileAs($path, new File($localFile), $file);

      // Delete temp file
      unlink($localFile);

   } // end method moveFileStorage
}
