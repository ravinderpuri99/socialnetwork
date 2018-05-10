<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{

	use SoftDeletes;

    //protected $table = 'the _name_of_the_table';

	//White list attributes
    protected $fillable = [
    	'user_id', 'title', 'content', 'live', 'post_on'
    ];

    protected $dates = [
    	'post_on', 'deleted_at'
    ];

    public function setLiveAttribute($value)
    {
    	$this->attributes['live'] = (boolean)($value);
    }

    public function getShortContentAttribute()
    {
    	return substr($this->content, 0, random_int(60, 150)). '...';
    }

    public function setPostOnAttribute($value)
    {
    	$this->attributes['post_on'] = Carbon::parse($value);
    }
}