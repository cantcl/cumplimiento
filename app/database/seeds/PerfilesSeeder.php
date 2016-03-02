<?php

class PerfilesSeeder extends Seeder {
    public function run(){
        DB::table('perfiles')->delete();

        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');

        DB::table('perfiles')->insert(array(
          array('id' => 1, 'titulo' => 'Administrador','created_at' => $date,'updated_at' => $date),
          array('id' => 2, 'titulo' => 'Responsable Institucional','created_at' => $date,'updated_at' => $date),
          array('id' => 3, 'titulo' => 'Jefe de Proyecto','created_at' => $date,'updated_at' => $date),
          array('id' => 4, 'titulo' => 'Responsable de comunicaciones', 'created_at' => $date,'updated_at' => $date)
        ));
    }
}
