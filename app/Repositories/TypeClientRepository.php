<?php

namespace App\Repositories;

use App\Models\TypeClient;
use App\Repositories\BaseRepository;

/**
 * Class TypeClientRepository
 * @package App\Repositories
 * @version August 31, 2020, 9:22 pm UTC
*/

class TypeClientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'libelle'
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
        return TypeClient::class;
    }
}
