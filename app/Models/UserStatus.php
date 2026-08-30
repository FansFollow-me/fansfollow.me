<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $guarded = [];
    /**
 * The table associated with the model.
 *
 * @var string
 */
protected $table = 'user_status';
    public function user()
	{
		return $this->belongsTo(User::class)->first();
	}

    public function media()
    {
		return $this->hasMany(MediaStories::class)->whereStatus(1);
    }
}
