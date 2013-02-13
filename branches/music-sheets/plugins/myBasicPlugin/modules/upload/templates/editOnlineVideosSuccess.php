<div class="image_edit_container">
  <div class="image_edit_container_preview">
    <?php $aux = $obj->retrieveYouTubeEmbeddedCode(array("width" => 300, "height"=> 300)); ?>
    <?php echo $aux; ?>
    <div class="clear"></div>
  </div>
  <div id="image_edit_container_form" class="image_edit_container_form">
    <?php //include_partial("imageEditForm", array("form" => $form)); ?>
    
  </div>
  
</div>