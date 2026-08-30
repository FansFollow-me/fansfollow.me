<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $guarded = [];
    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }

    /**
     * Get the seller
     */
    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Images Previews
     */
    public function previews()
    {
        return $this->hasMany(MediaProducts::class);
    }

    /**
     * Get Purchases
     */
    public function purchases()
    {
        return $this->hasMany(Purchases::class);
    }

    /**
     * Country Free Shipping
     */
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_free_shipping')->first();
      }

      /**
       * Country Free Categories
       */
      public function categoryId()
   	 {
   	 	 return $this->belongsTo(ShopCategories::class, 'category');
   	 }
   	 
   	 /*My Changes*/
    public function comments() {
		return $this->hasMany('App\Models\Comments', 'updates_id')->where('is_shop', 'yes');
	}
	public function replies()
	{
		return $this->hasMany(Replies::class, 'updates_id');
	}
	public function likes() {
		return $this->hasMany('App\Models\Like', 'updates_id')->where('status', '1')->where('is_shop', 'yes');
	}
	public function totalComments()
	{
		$post = $this->withCount(['comments', 'replies'])->whereId($this->id)->get();

		return number_format($post[0]->comments_count + $post[0]->replies_count);
	}
	/*My Changes en*/
}
