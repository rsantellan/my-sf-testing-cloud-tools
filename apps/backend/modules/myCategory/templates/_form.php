<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="<?php echo url_for('@saveCategory') ?>" method="post" onsubmit="return myCategoryManager.getInstance().saveForm(this);">
  <?php echo $form->renderHiddenFields(false) ?>
  <?php echo $form->renderGlobalErrors() ?>
  <div class="block">
      <label style="float:left;"><?php echo __('categorias_text_name'); ?></label>
      <div style="float: left; padding: 2px; margin: 2px;" class="<?php if($form[$sf_user->getCulture()]['name']->hasError()):?>error_msg<?php endif; ?>">
          <?php echo $form[$sf_user->getCulture()]['name']->render(); ?>
      </div>
      <div>
        <?php if($form[$sf_user->getCulture()]['name']->hasError()): echo $form[$sf_user->getCulture()]['name']->renderLabelName() .': '. $form[$sf_user->getCulture()]['name']->getError();  endif; ?>
      </div>
  </div>
  <div class="clear"></div>
  <div class="block">
      <label style="float:left;"><?php echo __('categorias_text_description'); ?></label>
      <div style="float: left; padding: 2px; margin: 2px;" class="<?php if($form[$sf_user->getCulture()]['description']->hasError()):?>error_msg<?php endif; ?>">
          <?php echo $form[$sf_user->getCulture()]['description']->render(); ?>
      </div>
      <div>
        <?php if($form[$sf_user->getCulture()]['description']->hasError()): echo $form[$sf_user->getCulture()]['description']->renderLabelName() .': '. $form[$sf_user->getCulture()]['description']->getError();  endif; ?>
      </div>
  </div>
  <div class="clear"></div>
  <input type="button" value="<?php echo __('categorias_cancelar');?>" onclick="myCategoryManager.getInstance().cancelForm();" />
  <input type="submit" value="<?php echo __('categorias_salvar');?>" />
</form>

