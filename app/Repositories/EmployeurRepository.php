<?php

namespace App\Repositories;

use App\Models\Employeur;
use App\Repositories\BaseRepository;

/**
 * Class EmployeurRepository
 * @package App\Repositories
 * @version August 31, 2020, 9:24 pm UTC
*/

class EmployeurRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nomEmployeur',
        'raisonSociale',
        'cni'
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
        return Employeur::class;
    }
}
