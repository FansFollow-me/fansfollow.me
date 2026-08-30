<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  protected $fillable = [
    'updates_id',
    'user_id',
    'type',
    'image',
    'width',
    'height',
    'video',
    'thumimge', /*My Changes*/
    'video_poster',
    'preview', /*My Changes*/
    'is_embed', /*My changes*/
    'video_embed',
    'music',
    'file',
    'file_name',
    'file_size',
    'img_type',
    'token',
    'status',
    'created_at'
  ];

  public function user() {
        return $this->belongsTo('App\Models\User')->first();
    }

  public function updates() {
        return $this->belongsTo('App\Models\Updates');
    }
    
    /*My Changes*/
	public function views() {
		return $this->hasMany('App\Models\PostViews')->where('post_type', 'post');
	}

}
