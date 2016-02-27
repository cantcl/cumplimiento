<?php
/**
 * Created by PhpStorm.
 * User: nsilva
 * Date: 13-05-14
 * Time: 12:12
 */

class Perfil extends Eloquent{

    protected $table='perfiles';
    protected $fillable=array('titulo');

    public function usuarios(){
        return $this->belongsToMany('Usuario');
    }
}
