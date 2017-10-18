<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = [
        'image', 
    ];

    public function post()
  	{
    	return $this->belongsTo('App\Post', 'image_id');
  	}
}
