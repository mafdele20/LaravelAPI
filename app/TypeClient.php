<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeClient extends Model
{
    protected $fillable = [
        'libelle'
    ];
  
    public function clients()
    {
        return $this->hasMany('App\Client');
    }
}
