<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Compte",
 *      required={"numero", "cleRib", "date", "etat", "solde", "frais", "type_compte_id", "client_id", "deleted_at"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="numero",
 *          description="numero",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cleRib",
 *          description="cleRib",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="etat",
 *          description="etat",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="solde",
 *          description="solde",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="frais",
 *          description="frais",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="type_compte_id",
 *          description="type_compte_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="client_id",
 *          description="client_id",
 *          type="integer",
 *          format="int32"
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
class Compte extends Model
{
    use SoftDeletes;

    public $table = 'comptes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'numero',
        'cleRib',
        'date',
        'etat',
        'solde',
        'frais',
        'type_compte_id',
        'client_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'numero' => 'string',
        'cleRib' => 'string',
        'date' => 'date',
        'etat' => 'boolean',
        'solde' => 'decimal:2',
        'frais' => 'decimal:2',
        'type_compte_id' => 'integer',
        'client_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'numero' => 'required|string|max:255',
        'cleRib' => 'required|string|max:255',
        'date' => 'required',
        'etat' => 'required|boolean',
        'solde' => 'required|numeric',
        'frais' => 'required|numeric',
        'type_compte_id' => 'required',
        'client_id' => 'required',
        'deleted_at' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function typeCompte()
    {
        return $this->belongsTo(\App\Models\TypeCompte::class, 'type_compte_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function operations()
    {
        return $this->hasMany(\App\Models\Operation::class, 'compte_id');
    }
}
