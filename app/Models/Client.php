<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Client",
 *      required={"adresse", "email", "telephone", "salaire", "deleted_at"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nom",
 *          description="nom",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="prenom",
 *          description="prenom",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="adresse",
 *          description="adresse",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="telephone",
 *          description="telephone",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="salaire",
 *          description="salaire",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="nomEntreprise",
 *          description="nomEntreprise",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="typeclient",
 *          description="typeclient",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="employeur_id",
 *          description="employeur_id",
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
class Client extends Model
{
    use SoftDeletes;

    public $table = 'clients';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'prenom',
        'adresse',
        'email',
        'telephone',
        'salaire',
        'nomEntreprise',
        'typeclient',
        'employeur_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'prenom' => 'string',
        'adresse' => 'string',
        'email' => 'string',
        'telephone' => 'integer',
        'salaire' => 'decimal:2',
        'nomEntreprise' => 'string',
        'typeclient' => 'integer',
        'employeur_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'nullable|string|max:255',
        'prenom' => 'nullable|string|max:255',
        'adresse' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'telephone' => 'required|integer',
        'salaire' => 'required|numeric',
        'nomEntreprise' => 'nullable|string|max:255',
        'typeclient' => 'nullable',
        'employeur_id' => 'nullable',
        'deleted_at' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function employeur()
    {
        return $this->belongsTo(\App\Models\Employeur::class, 'employeur_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function typeclient()
    {
        return $this->belongsTo(\App\Models\TypeClient::class, 'typeclient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function comptes()
    {
        return $this->hasMany(\App\Models\Compte::class, 'client_id');
    }
}
