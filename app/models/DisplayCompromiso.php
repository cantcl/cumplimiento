<?php
/**
 * Created by PhpStorm.
 * User: nsilva
 * Date: 13-05-14
 * Time: 12:12
 */

class DisplayCompromiso extends Eloquent{

    protected $table='display_compromisos';
    protected $fillable=array('campos');

    public function compromisos(){
        return $this->belongsToMany('Compromiso');
    }
}
