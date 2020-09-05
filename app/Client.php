<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
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

    public function employeur()
    {
        return $this->belongsTo('App\Employeur');
    }

    public function typeClient()
    {
        return $this->belongsTo('App\TypeClient');
    }

    public function comptes()
    {
        return $this->hasMany('App\Compte');
    }
}
