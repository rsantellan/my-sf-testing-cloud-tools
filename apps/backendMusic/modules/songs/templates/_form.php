<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('songs/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('songs/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'songs/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha_publicacion']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha_publicacion']->renderError() ?>
          <?php echo $form['fecha_publicacion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['remix']->renderLabel() ?></th>
        <td>
          <?php echo $form['remix']->renderError() ?>
          <?php echo $form['remix'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['m_group_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['m_group_id']->renderError() ?>
          <?php echo $form['m_group_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['m_group_original_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['m_group_original_id']->renderError() ?>
          <?php echo $form['m_group_original_id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
