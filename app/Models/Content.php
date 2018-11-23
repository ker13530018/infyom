<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Content
 * @package App\Models
 * @version November 22, 2018, 7:17 am UTC
 *
 * @property string title
 * @property string description
 * @property string og_type
 * @property string og_description
 * @property string og_images
 * @property string robots
 * @property string body
 * @property integer status
 */
class Content extends Model
{
    use SoftDeletes;

    public $table = 'contents';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'description',
        'og_type',
        'og_description',
        'og_images',
        'robots',
        'body',
        'status',
        'created_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'og_type' => 'string',
        'og_description' => 'string',
        'og_images' => 'string',
        'robots' => 'string',
        'body' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:100',
        'description' => 'required|max:250',
        'og_type' => 'required|max:50',
        'og_description' => 'required|max:200',
        'body' => 'max:30000',
        'status' => 'required'
    ];

    
}
