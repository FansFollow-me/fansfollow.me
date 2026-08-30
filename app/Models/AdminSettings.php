<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSettings extends Model {

	protected $guarded = array();
	public $timestamps = false;

	protected static function currentTableName()
	{
		if (! app()->runningInConsole()) {
			$path = ltrim(parse_url(request()->getRequestUri(), PHP_URL_PATH) ?? '', '/');
			if ($path === 'staging_new' || str_starts_with($path, 'staging_new/')) {
				return 'stg_admin_settings';
			}
		}

		return 'admin_settings';
	}

	public function getTable()
	{
		return static::currentTableName();
	}

	public static function forCurrentRequest()
	{
		return (new static)->newQuery()->from(static::currentTableName())->first();
	}
}
