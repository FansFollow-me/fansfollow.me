<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorStatus extends Model
{
    protected $guarded = [];
    /**
 * The table associated with the model.
 *
 * @var string
 */
protected $table = 'creator_status';
    public function user()
	{
		return $this->belongsTo(User::class)->first();
	}

    public function status()
    {
		return $this->hasMany(UserStatus::class,'status_id');
    }
}
