<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version May 4, 2019, 6:45 pm UTC
*/

class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
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
        return Category::class;
    }

    /**
     * Retrieve a specific record with specify columns by it Id including given relationship (key)
     *
     * @param int $id
     * @param array $key
     * @param array $columns
     *
     * @return App\Models\Category
     */
    public function findByIdWith($id, $key, $columns = ['*']){
        return Category::with($key)->find($id, $columns);
    }
}
