<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
	protected $fillable = ['nombre'];
	
    public function ciudades()
    {
    	return $this->hasMany(Ciudad::class);
    }
}
