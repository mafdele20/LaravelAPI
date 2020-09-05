<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Employeur",
 *      required={"nomEmployeur", "raisonSociale", "cni", "deleted_at"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nomEmployeur",
 *          description="nomEmployeur",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="raisonSociale",
 *          description="raisonSociale",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cni",
 *          description="cni",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
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
class Employeur extends Model
{
    use SoftDeletes;

    public $table = 'employeurs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nomEmployeur',
        'raisonSociale',
        'cni'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nomEmployeur' => 'string',
        'raisonSociale' => 'string',
        'cni' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nomEmployeur' => 'required|string|max:55',
        'raisonSociale' => 'required|string|max:255',
        'cni' => 'required|string|max:255',
        'deleted_at' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clients()
    {
        return $this->hasMany(\App\Models\Client::class, 'employeur_id');
    }
}
