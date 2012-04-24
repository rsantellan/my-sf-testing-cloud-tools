<?php
//Ingreso el slot
slot('traductor', 'traductor');

// Aca pongo todos los js que correspondan
use_plugin_javascript("myBasicPlugin","jquery-1.7.1.min.js", "first");
use_plugin_javascript("myBasicPlugin","myTranslator.js", "last");
use_plugin_stylesheet("myBasicPlugin","traductor.css");
use_plugin_stylesheet("myBasicPlugin","jquery.cleditor.css");
use_plugin_javascript("myBasicPlugin", "jquery.cleditor.js", "last");
?>

<?php echo __("traductor_titulo"); ?>

<form action="index" method="post" style="padding-left: 20px;">
  <div class="grid_3">
  <p>
	<?php echo $selectionForm['application']->renderLabel() ?>
	<?php echo $selectionForm['application']->render() ?>
  </p>
  </div>
  <div class="grid_3">
  <p>
	<?php echo $selectionForm['catalogue']->renderLabel() ?>
	<?php echo $selectionForm['catalogue']->render() ?>
  </p>
  </div>
  <div class="grid_3">
  <p>
	<?php echo $selectionForm['base_language']->renderLabel() ?>
	<?php echo $selectionForm['base_language']->render() ?>
  </p>
  </div>
  <div class="grid_3">
  <p>
	<?php echo $selectionForm['language']->renderLabel() ?>
	<?php echo $selectionForm['language']->render() ?>
  </p>
  </div>
  <div class="clear"></div>
  <span><?php echo __("traductor_secciones");?></span>
  <div id="app_pages" class="chkListOut"></div><div style="clear:both"></div>
</form>

<hr/>
<div id="datos" class="tr_datos_container"></div>
<div id="contenido" class="tr_contenido"></div>
<h2><?php echo $error?></h2>


<input type="hidden" id="application_page_ajax_url" value="<?php echo url_for("@traductor_getpages");?>" />
<input type="hidden" id="application_langs_ajax_url" value="<?php echo url_for("@traductor_getlangs");?>" />
<input type="hidden" id="application_texts_ajax_url" value="<?php echo url_for("@traductor_gettexts");?>" />

<input type="hidden" id="application_text_content_ajax_url" value="<?php echo url_for("@traductor_gettext_content");?>" />