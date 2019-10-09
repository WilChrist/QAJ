<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\BaseRepository;

/**
 * Class AuthorRepository
 * @package App\Repositories
 * @version May 4, 2019, 8:07 pm UTC
*/

class AuthorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'full_name',
        'popular_name',
        'biography',
        'link_to_full_biography'
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
        return Author::class;
    }
    /**
     * Retrieve a specific record with specify columns by it Id including given relationship (key)
     *
     * @param int $id
     * @param array $key
     * @param array $columns
     *
     * @return App\Models\Author
     */
    public function findByIdWith($id, $key, $columns = ['*']){
        return Author::with($key)->find($id, $columns);
    }
}
