<?php
//Ingreso el slot
slot('usuarios', 'usuarios');
?>

<div class="grid_16">
  <h2><?php echo __("usuarios_agregar titulo") ?></h2>
</div>


<?php include_partial('form', array('form' => $form)) ?>
