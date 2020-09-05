<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employeur extends Model
{
    protected $fillable = [
        'nomEmployeur',
        'raisonSociale',
        'cni'
    ];
  
    public function clients()
    {
        return $this->hasMany('App\Client');
    }
}
