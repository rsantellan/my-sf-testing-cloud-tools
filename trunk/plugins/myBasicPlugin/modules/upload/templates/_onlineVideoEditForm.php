<form action="<?php echo url_for("@saveEditImageForm");?>" id="image_edit_form" method="post" onsubmit="return saveImageDataForm(this);">
  <?php echo $form->renderHiddenFields(false) ?>
  <?php echo $form->renderGlobalErrors() ?>
  <div class="block">
    <label style="float:left;"><?php echo __('upload_file name'); ?></label>
    <div class="clear"></div>
    <div style="float: left; padding: 2px; margin: 2px;" class="<?php if($form['name']->hasError()):?>error_msg<?php endif; ?>">
        <?php echo $form['name']->render(); ?>
    </div>
    <div>
      <?php if($form['name']->hasError()): echo $form['name']->renderLabelName() .': '. $form['name']->getError();  endif; ?>
    </div>
  </div>
  <div class="clear"></div>
  <div class="block">
    <label style="float:left;"><?php echo __('upload_file description'); ?></label>
    <div class="clear"></div>
    <div>
      <?php if($form['description']->hasError()): echo $form['description']->renderLabelName() .': '. $form['description']->getError();  endif; ?>
    </div>
    <div class="clear"></div>
    <div style="float: left; padding: 2px; margin: 2px;" class="<?php if($form['description']->hasError()):?>error_msg<?php endif; ?>">
        <?php echo $form['description']->render(); ?>
    </div>
    
  </div>
  <div class="clear"></div>
</form>
<input type="button" value="<?php echo __("upload_guardar");?>" onclick="$('#image_edit_form').submit()" />