<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaProducts extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    /*My Changes*/
	public function views() {
		return $this->hasMany('App\Models\PostViews', 'media_id')->where('post_type', 'shop');
	}
}
