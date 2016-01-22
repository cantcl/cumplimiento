<?php
/**
 * Created by PhpStorm.
 * User: nsilva
 * Date: 13-05-14
 * Time: 11:45
 */

class Asociado extends Eloquent{

    protected $table = 'asociados';
    protected $fillable=array('asociado');

    public function compromiso(){
        return $this->belongsTo('Compromiso');
    }

}
