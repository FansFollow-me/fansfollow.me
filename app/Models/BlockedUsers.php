<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedUsers extends Model {

	protected $guarded = array();
	public $timestamps = false;

	public function user()
    {
      return $this->belongsTo(User::class)->first();
    }

    public function userBlockedBy()
    {
      return $this->belongsTo(User::class, 'blocked_by')->first();
    }

}
