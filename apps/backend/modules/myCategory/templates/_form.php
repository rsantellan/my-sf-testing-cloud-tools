<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('@saveCategory') ?>" method="post" onsubmit="return myCategoryManager.getInstance().saveForm(this);">
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="<?php echo __('categorias_salvar');?>" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      
      
      
      <?php echo $form;?>
      
    </tbody>
  </table>
</form>

