<?php
//Ingreso el slot
slot('usuarios', 'usuarios');
?>

<h1><?php echo __("usuarios_titulo de los usuarios") ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __("usuarios_First name") ?></th>
      <th><?php echo __("usuarios_Last name") ?></th>
      <th><?php echo __("usuarios_Email address") ?></th>
      <th><?php echo __("usuarios_Username") ?></th>
      <th><?php echo __("usuarios_Is active") ?></th>
      <th><?php echo __("usuarios_Is super admin") ?></th>
      <th><?php echo __("usuarios_Last login") ?></th>
      <th><?php echo __("usuarios_opciones") ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sf_guard_users as $sf_guard_user): ?>
    <tr>
      <td><?php echo $sf_guard_user->getFirstName() ?></td>
      <td><?php echo $sf_guard_user->getLastName() ?></td>
      <td><?php echo $sf_guard_user->getEmailAddress() ?></td>
      <td><?php echo $sf_guard_user->getUsername() ?></td>
      <td>
        <?php echo ($sf_guard_user->getIsActive())? __("usuarios_si") : __("usuarios_no"); ?>
      </td>
      <td>
        <?php echo ($sf_guard_user->getIsSuperAdmin())? __("usuarios_si") : __("usuarios_no"); ?>
      </td>
      <td><?php echo $sf_guard_user->getLastLogin() ?></td>
      <td>
        <a href="<?php echo url_for('@editUsers?id='.$sf_guard_user->getId()) ?>"><?php echo __("usuarios_editar") ?></a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('@addUsers') ?>"><?php echo __("usuarios_agregar") ?></a>
