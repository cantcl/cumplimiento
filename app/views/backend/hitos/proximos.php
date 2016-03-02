<ol class="breadcrumb">
    <li><a href="<?=URL::to('backend')?>">Inicio</a></li>
    <li><a href="<?=URL::to('backend/hitos')?>">Hitos</a></li>
    <li class="active">Próximos hitos relevantes</li>
</ol>


<table class="table">
    <thead>
    <tr>
        <th>Hito</th>
        <th>Medida</th>
        <th>Responsable</th>
        <th>Fecha Inicio</th>
        <th>Fecha Término</th>
        <th>Medio de Verificación</th>
        <th>Medio de Verificación (URL)</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($hitos as $h):?>
    <tr>
        <td><?=$h->descripcion?></td>
        <td><a href="<?=URL::to('backend/compromisos/editar/'.$h->compromiso->id)?>"><?=$h->compromiso->nombre?></a></td>
        <?php
          $responsable = 'Administrador';
          $resp_id = $h->compromiso->autoridad_responsable;

          if($resp_id != ''){
            $responsable = Usuario::where('id' , '=', $resp_id)->get()->first()->nombres;
          }
        ?>
        <td><?php echo $responsable; ?></td>
        <td><time><?=$h->fecha_inicio?></time></td>
        <td><time><?=$h->fecha_termino?></time></td>
        <td><?=$h->verificacion_descripcion?></td>
        <td><a href="<?=$h->verificacion_url?>" target="_blank"><?=$h->verificacion_url?></a></td>
    </tr>
    <?php endforeach ?>
    </tbody>
</table>
