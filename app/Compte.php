<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $fillable = [
        'numero', 
        'cleRib', 
        'date', 
        'etat',
        'solde', 
        'frais', 
        'type_compte_id',
        'client_id'
 
    ];

    public function typeCompte()
    {
        return $this->belongsTo('App\TypeCompte');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

}
