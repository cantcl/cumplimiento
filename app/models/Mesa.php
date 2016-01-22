<?php
/**
 * Created by PhpStorm.
 * User: nsilva
 * Date: 13-05-14
 * Time: 11:45
 */

class Mesa extends Eloquent{

    protected $table = 'mesas';
    protected $fillable=array('nombre','tema','tipo','sesiones','verificacion');

    /*public function getDates()
    {
        return array('updated_at','created_at','fecha_inicio','fecha_termino');
    }*/

    public function compromiso(){
        return $this->belongsTo('Compromiso');
    }

}
