<?php

namespace App\Repositories;

use App\Models\Language;
use App\Repositories\BaseRepository;

/**
 * Class LanguageRepository
 * @package App\Repositories
 * @version May 4, 2019, 8:18 pm UTC
*/

class LanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Language::class;
    }
}
