<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Author",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="full_name",
 *          description="full_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="popular_name",
 *          description="popular_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="biography",
 *          description="biography",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="link_to_full_biography",
 *          description="link_to_full_biography",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Author extends Model
{

    public $table = 'authors';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'full_name',
        'popular_name',
        'biography',
        'link_to_full_biography'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'full_name' => 'string',
        'popular_name' => 'string',
        'biography' => 'string',
        'link_to_full_biography' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'full_name' => 'required',
        'popular_name' => 'required',
        'biography' => 'required',
        'link_to_full_biography' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function quotes()
    {
        return $this->hasMany(\App\Models\Quote::class);
    }
}
