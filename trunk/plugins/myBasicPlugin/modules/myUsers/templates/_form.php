<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('myUsers/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php if (!$form->getObject()->isNew()): ?>
  <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>
<?php echo $form->renderHiddenFields(false) ?>
<?php echo $form->renderGlobalErrors() ?>
<div class="grid_5">
  <p>
    <label for="<?php echo $form['first_name']->renderId (); ?>"><?php echo __("usuarios_First name") ?></label>
    <?php echo $form['first_name'] ?>
  </p>
</div>
<div class="grid_5">
  <p>
    <label for="<?php echo $form['last_name']->renderId (); ?>"><?php echo __("usuarios_Last name") ?></label>
    <?php echo $form['last_name'] ?>
  </p>
</div>

<div class="grid_5">
  <p>
    <label for="<?php echo $form['email_address']->renderId (); ?>"><?php echo __("usuarios_Email address") ?> <small>* <?php echo $form['email_address']->getError() ?></small></label>
    <?php 
    $class = "";
    if($form['email_address']->hasError()) $class = 'input_error';
    echo $form['email_address']->render(array('class' => $class)) 
    ?>
  </p>
</div>

<div class="clear"></div>

<div class="grid_5">
  <p>
    <label for="<?php echo $form['username']->renderId (); ?>"><?php echo __("usuarios_Username") ?><small>* <?php echo $form['username']->getError() ?></small></label>
    <?php 
    $class = "";
    if($form['username']->hasError()) $class = 'input_error';
    echo $form['username']->render(array('class' => $class)) 
    ?>
  </p>
</div>
<?php if($form->isNew()): ?>
<div class="grid_5">
  <p>
    <label for="<?php echo $form['password']->renderId (); ?>"><?php echo __("usuarios_contraseña") ?><small>* <?php echo $form['password']->getError() ?></small></label>
    <?php 
    $class = "";
    if($form['password']->hasError()) $class = 'input_error';
    echo $form['password']->render(array('class' => $class)) 
    ?>
  </p>
</div>

<div class="grid_5">
  <p>
    <label for="<?php echo $form['password_confirmation']->renderId (); ?>"><?php echo __("usuarios_confirmacion de contraseña") ?> <small>* <?php echo $form['password_confirmation']->getError() ?></small></label>
    <?php 
    $class = "";
    if($form['password_confirmation']->hasError()) $class = 'input_error';
    echo $form['password_confirmation']->render(array('class' => $class)) 
    ?>
  </p>
</div>
<?php endif;?>

<div class="clear"></div>
<div class="grid_5">
  <p>
    <label for="<?php echo $form['is_active']->renderId (); ?>"><?php echo __("usuarios_Is active") ?> </label>
    <?php echo $form['is_active'] ?>
  </p>
</div>
<div class="grid_5">
  <p>
    <label for="<?php echo $form['is_super_admin']->renderId (); ?>"><?php echo __("usuarios_Is super admin") ?> </label>
    <?php echo $form['is_super_admin'] ?>
  </p>
</div>
<div class="clear"></div>

<?php
$not_use_groups_and_permissions = sfConfig::get('app_my_sf_guard_plugin_use_permission_and_groups', false);
?>

<div class="grid_5 <?php echo (!$not_use_groups_and_permissions) ? 'hide' : ''; ?>">
  <p>
    <label for="<?php echo $form['groups_list']->renderId (); ?>"><?php echo $form['groups_list']->renderLabelName() ?> </label>
    <?php echo $form['groups_list'] ?>
  </p>
</div>
<div class="grid_5 <?php echo (!$not_use_groups_and_permissions) ? 'hide' : ''; ?>">
  <p>
    <label for="<?php echo $form['permissions_list']->renderId (); ?>"><?php echo $form['permissions_list']->renderLabelName() ?> </label>
    <?php echo $form['permissions_list']->render() ?>
  </p>
</div>
<div class="clear"></div>

<div class="right_aligned">
  <input type="submit" value="<?php echo __("formulario_guardar") ?>" />
</div>
</form>
<div class="clear"></div>  

<?php echo $form->renderHiddenFields(false) ?>
&nbsp;<a href="<?php echo url_for('myUsers/index') ?>">Back to list</a>
<?php if (!$form->getObject()->isNew()): ?>
&nbsp;<?php echo link_to('Delete', 'myUsers/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
<?php endif; ?>
