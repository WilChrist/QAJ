<?php

namespace App\Repositories;

use App\Models\Quote;
use App\Repositories\BaseRepository;

/**
 * Class QuoteRepository
 * @package App\Repositories
 * @version May 4, 2019, 8:22 pm UTC
*/

class QuoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'link_to_the_source',
        'approuved',
        'author_id',
        'language_id',
        'user_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Quote::class;
    }

    public function allWith($key){
        return Quote::with($key)->get();
    }
    public function findByIdWith($id,$key){
        return Quote::with($key)->find($id);
    }
    public function allSSLCWith($search = [], $skip = null, $limit = null, $columns = ['*'], $relations = [])
    {
        $query = $this->allQuery($search, $skip, $limit);
        $query->with($relations);
        return $query->get($columns);
    }
}
