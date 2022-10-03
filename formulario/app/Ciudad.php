<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
	protected $fillable = ['nombre'];
	
    public function tiendas()
    {
    	return $this->hasMany(Tienda::class);
    }
}
