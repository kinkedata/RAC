<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sugerencia extends Model
{
    protected $fillable = ['nombre','celular','email','solicitud','comentarios','estado_id','ciudad_id','tienda_id','status_id'];
	
    public function estado()
    {
    	return $this->hasOne(Estado::class, 'id', 'estado_id');
    }

    public function ciudad()
    {
    	return $this->hasOne(Ciudad::class, 'id', 'ciudad_id');
    }

    public function tienda()
    {
    	//return $this->hasOne(Tienda::class, 'id', 'tienda_id');
		return $this->hasOne('App\Tienda', 'id', 'tienda_id');
    }

    public function status()
    {
    	return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function notas()
    {
    	return $this->hasMany(NotaSugerencia::class);
    }
}
