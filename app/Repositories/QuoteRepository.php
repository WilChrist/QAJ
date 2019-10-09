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

    /**
     * Retrieve all records including given relationship
     *
     * @param array $key
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allWith($key){
        return Quote::where('approuved','=','1')->with($key)->get();
    }
    public function findByIdWith($id, $key, $columns = ['*']){
        return Quote::where('approuved','=','1')->with($key)->find($id, $columns);
    }
    /**
     * Retrieve all records including given relationship with pagination
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     * @param array $relations
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allSSLCWith($search = [], $skip = null, $limit = null, $columns = ['*'], $relations = [])
    {
        $query = $this->allQuery($search, $skip, $limit)->where('approuved','=','1');
        $query->with($relations);
        return $query->get($columns);
    }
}
