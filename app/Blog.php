<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Blog extends Model
{

	use SoftDeletes;

	/**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'd-m-Y H:i:s';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_on',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'uid',
	 	'title', 
	 	'text', 
        'published_on',
	 	'blog_image',
        'deleted_at'
 	];

    /**
     * Accessor for published_on field
     * To change the the format of published_on field while accessing it
     * @var $value string
     * @return Carbon
     */

    public function getPublishedOnAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    /**
     * Mutator for published_on field
     * To change the the format of published_on field while storing it
     * @var $value string
     */

    public function setPublishedOnAttribute($value)
    {
        $this->attributes['published_on'] = Carbon::parse($value)->format('d-m-Y H:i:s');
    } 

    /**
     * Get author of a blog
     * 
     * @return mix
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

	/**
     * To ckeck whether a blog has been published yet or not
     */

    public function isPublished()
    {
        //return ($this->user_type == 'admin') ? true : false;
    }

}
