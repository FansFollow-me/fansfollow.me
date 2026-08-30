<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
/*My Changes*/
use FFMpeg;
use FFMpeg\Format\Video\X264;
use App\Models\User;
use App\Models\Updates;
use App\Models\Messages;
use App\Models\MediaProducts;
use App\Models\AdminSettings;
use App\Models\Media;
use Carbon\Carbon;
use App\Helper;
use Image;
use FileUploader;

class UploadMediaPreviewShopController extends Controller
{

	public function __construct(AdminSettings $settings, Request $request)
  {
		$this->settings = $settings::first();
		$this->request = $request;
		$this->path = config('path.shop');
    $this->middleware('auth');
	}

	/**
     * submit the form
     *
     * @return void
     */
	public function store()
	{
		$publicPath = public_path('temp/');
		$file = strtolower(auth()->id().uniqid().time().str_random(20));

		// initialize FileUploader
		$FileUploader = new FileUploader('preview', array(
		    /*My Changes */
			'limit' => $this->settings->maximum_files_post,
			'fileMaxSize' => floor($this->settings->file_size_allowed / 1024),
            /*My Changes */
	    	'extensions' => [
              'png',
              'jpeg',
              'jpg',
              'gif',
              'video/mp4',
              'video/quicktime',
              'video/3gpp',
              'video/mpeg',
              'video/x-matroska',
              'video/x-ms-wmv',
              'video/vnd.avi',
              'video/avi',
              'video/x-flv'
            ],
			'title' => $file,
			'uploadDir' => $publicPath
		));

		// upload
		$upload = $FileUploader->upload();

		if ($upload['isSuccess']) {

			foreach($upload['files'] as $key=>$item) {
				$upload['files'][$key] = [
					'extension' => $item['extension'],
					'format' => $item['format'],
					'name' => $item['name'],
					'size' => $item['size'],
					'size2' => $item['size2'],
					'type' => $item['type'],
					'uploaded' => true,
					'replaced' => false
				];
                //My changes
                switch ($item['format']) {
					case 'image':
					    if($item['extension'] == 'gif'){
					    // Insert in Database
				 $this->insertImage($item['name'], 0, 0, 0);
    
				 // Move file to Storage
				// $item['file']->move('public/'.$this->path,$item['name']);
				 $this->moveFileStorage($item['name'], $this->path);
					    }
				 else{
							$this->resizeImage($item['name'], $item['extension']);
				 }
						break;

					case 'video':
							$this->uploadVideo($item['name']);
						break;
				}
				

			}// foreach

		}// upload isSuccess

		return response()->json($upload);
	}

	/**
     * Resize image and add watermark
     *
     * @return void
     */
		 protected function resizeImage($image, $extension)
		 {
			 $fileName = $image;
			 $image = public_path('temp/').$image;
			 $img   = Image::make($image);
			 $token = str_random(150).uniqid().now()->timestamp;
			 $url   = ucfirst(Helper::urlToDomain(url('/')));

			 $width     = $img->width();
			 $height    = $img->height();

				 //=============== Image Large =================//
				 if ($width > 2000) {
					 $scale = 2000;
				 } else {
					 $scale = $width;
				 }

				 // Calculate font size
				 if ($width >= 400 && $width < 900) {
					 $fontSize = 18;
				 } elseif ($width >= 800 && $width < 1200) {
					 $fontSize = 24;
				 } elseif ($width >= 1200 && $width < 2000) {
					 $fontSize = 32;
				 } elseif ($width >= 2000 && $width < 3000) {
					 $fontSize = 50;
				 } elseif ($width >= 3000) {
					 $fontSize = 75;
				 } else {
					 $fontSize = 0;
				 }

				 if ($this->settings->watermark == 'on') {
					 $img->orientate()->resize($scale, null, function ($constraint) {
						 $constraint->aspectRatio();
						 $constraint->upsize();
					 })->text($url.'/'.auth()->user()->username, $img->width() - 20, $img->height() - 10, function($font)
							 use ($fontSize) {
							 $font->file(public_path('webfonts/arial.TTF'));
							 $font->size($fontSize);
							 $font->color('#eaeaea');
							 $font->align('right');
							 $font->valign('bottom');
					 })->save();
				 } else {
					 $img->orientate()->resize($scale, null, function ($constraint) {
						 $constraint->aspectRatio();
						 $constraint->upsize();
					 })->save();
				 }
				 
				 
				 // Insert in Database
				 $this->insertImage($fileName, $width, $height, $token);

				 // Move file to Storage
				 $this->moveFileStorage($fileName, $this->path);

	 }// End method resizeImage
	 
	 /**
	      * Insert Image to Database
	      *
	      * @return void
	      */
		 protected function insertImage($image, $width, $height, $token)
		 {
       MediaProducts::create([
           'products_id' => 0,
           'name' => $image,
           'type' => 'image'
         ]);

		 }// end method insertImage
	 
	 /** My changes
	      * Upload Video
	      *
	      * @return void
	      */
				protected function uploadVideo($video)
				{
					$path = config('path.shop');
					$token = str_random(150).uniqid().now()->timestamp;
					/*My Changes*/
					$img_name = str_random(9).uniqid().now()->timestamp; 
					$localFile = public_path('temp/'.$video);
                    $result = shell_exec('sh /home/fansfollow/public_html/spritevideo -i '.$localFile.' -o /home/fansfollow/public_html/public/uploads/shop -p /home/fansfollow/public_html/public/uploads/shop/'.$img_name.'.jpeg');
					// We insert the file into the database with a status 'pending'
					$disk = 'default';
                    $path = 'temp/';
                    $videoPathDisk = $path.$video;
                  $videoPoster = str_random(20).uniqid().now()->timestamp.'-poster.jpg';
                
                  $ffmpeg = FFMpeg::fromDisk($disk)
                  ->open($videoPathDisk)
                    ->getFrameFromSeconds(1)
                    ->export()
                  ->toDisk($disk);
        
                  $ffmpeg->save($path.$videoPoster);
                  // Clean
                      FFMpeg::cleanupTemporaryFiles();
	        MediaProducts::create([
                   'products_id' => 0,
                   'name' => $video,
                   'type' => 'video',
                   'video_poster' => $videoPoster ?? null,
                   'thumimge' => $img_name.'.jpeg',
                   'status' => $this->settings->video_encoding == 'off' ? 'active' : 'active'
                 ]);
                    
                    if($videoPoster){
                        $this->moveFileStorage($videoPoster, $this->path);
                    }
					// Move file to Storage
				//	if ($this->settings->video_encoding == 'off') {
						$this->moveFileStorage($video, $this->path);
				//	}
				}


    /**
	      * Move file to Storage
	      *
	      * @return void
	      */
		 protected function moveFileStorage($file, $path)
		 {
			 $localFile = public_path('temp/'.$file);

            // Move the file...
            Storage::putFileAs($path, new File($localFile), $file);
            
			 // Delete temp file
			unlink($localFile);

		} 
		
		//My changes end method moveFileStorage

	/**
     * delete a file
     *
     * @return void
     */
	public function delete()
	{
		// PATH
		$local = 'temp/';

		// Delete local file
		Storage::disk('default')->delete($local.$this->request->file);

    return response()->json([
        'success' => true
    ]);
	}// End method

}
