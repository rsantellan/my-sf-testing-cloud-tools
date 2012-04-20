<?php use_helper('JavascriptBase'); ?>
<?php //use_helper( 'mdAsset' );  ?>
<div id="<?php echo $page ?>">
  <div style="margin-top:10px;" id="translate_form_<?php echo $index ?>">
        <?php if ($showText): ?>
          <a href="javascript:void(0)" class="show_reference" onclick="return myTranslator.getInstance().showReference($(this));"><?php echo __('traductor_mostrar referencia') ?></a>
          <div class="reference_text"><?php echo ($showText ? $form['translation_base_' . $index]->getValue() : ""); ?></div>
          <div class="clear"></div>
          <br>
        <?php endif; ?>
<!--		<form id="translation_form_<?php echo $index ?>" class="submitearForm" onsubmit="mdTranslator.getInstance().updateTextArea(); mdTranslator.getInstance().save($(this).find('input:[name=translation_source_<?php echo $index ?>]').val(),$(this).find('textarea:[name=translation_new_<?php echo $index ?>]').val(),<?php echo $index ?>); return false;" action="<?php echo url_for('mdTranslator/changeTextAjax'); ?>" method="post">		-->
        <form id="translation_form_" class="submitearForm" onsubmit="return myTranslator.getInstance().save(this, $(this).find('input:[name=translation_source_<?php echo $index ?>]').val(),$(this).find('textarea:[name=translation_new_<?php echo $index ?>]').val(),<?php echo $index ?>);" action="<?php echo url_for('@traductor_savetext'); ?>" method="post">
          <?php echo $form['translation_source_' . $index]->render() ?>
          <?php echo $form['translation_new_' . $index]->render(); ?>
          <input type="hidden" name="isTiny" id="isTiny" value="0"/>
          <div style="height: 50px;float:right;margin-top: 20px;">
            <input type="submit" value="Guardar"/>
            <input type="button" value="Cancelar" onclick="myTranslator.getInstance().removeLoadedTexts();"/>
          </div>

        </form>
        <?php echo $form->renderHiddenFields(); ?>

  </div>
  <?php
  echo javascript_tag("
		index++;
	");
  ?>
</div>
<div class="clear"></div>
