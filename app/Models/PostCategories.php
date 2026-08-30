<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model {

	protected $guarded = array();
	public $timestamps = false;

	public function user()
    {
      return $this->belongsTo(User::class)->first();
    }

    public function post()
    {
      return $this->belongsTo(Updates::class)->first();
    }

}
