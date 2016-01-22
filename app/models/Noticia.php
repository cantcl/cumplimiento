<?php
/**
 * Created by PhpStorm.
 * User: nsilva
 * Date: 13-05-14
 * Time: 11:45
 */

class Noticia extends Eloquent{

    protected $table = 'noticias';
    protected $fillable=array('titulo','descripcion','link');

    /*public function getDates()
    {
        return array('updated_at','created_at','fecha_inicio','fecha_termino');
    }*/

    public function compromiso(){
        return $this->belongsTo('Compromiso');
    }

}
