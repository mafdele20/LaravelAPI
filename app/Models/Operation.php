<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Operation",
 *      required={"taxe", "montant", "dateOperation", "type_operation", "compte_id", "deleted_at"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="taxe",
 *          description="taxe",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="montant",
 *          description="montant",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="dateOperation",
 *          description="dateOperation",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="type_operation",
 *          description="type_operation",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="compte_id",
 *          description="compte_id",
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
class Operation extends Model
{
    use SoftDeletes;

    public $table = 'operations';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'taxe',
        'montant',
        'dateOperation',
        'type_operation',
        'compte_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'taxe' => 'decimal:2',
        'montant' => 'decimal:2',
        'dateOperation' => 'date',
        'type_operation' => 'integer',
        'compte_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'taxe' => 'required|numeric',
        'montant' => 'required|numeric',
        'dateOperation' => 'required',
        'type_operation' => 'required',
        'compte_id' => 'required',
        'deleted_at' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function compte()
    {
        return $this->belongsTo(\App\Models\Compte::class, 'compte_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function typeOperation()
    {
        return $this->belongsTo(\App\Models\TypeOperation::class, 'type_operation');
    }
}
