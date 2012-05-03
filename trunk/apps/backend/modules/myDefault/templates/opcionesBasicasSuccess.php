<div style="height: 250px; width: 250px">
  
  <div>Aca va la parte de idiomas</div>
  <div class="clear"></div>
  <div style="text-align: center; margin-top: 16px;">
    <a href="<?php //echo url_for("@sf_guard_signout");?>">
      <?php echo plugin_image_tag("myBasicPlugin", "clean.png", array("alt" => __("opciones_limpiar cache"))); ?>
    </a>
    
  </div>
  <div class="clear"></div>
  <div style="text-align: center; margin-top: 16px;"> 
    <a href="<?php echo url_for("@sf_guard_signout");?>">
      <?php echo plugin_image_tag("myBasicPlugin", "logout.png", array("alt" => __("opciones_logout"))); ?>
    </a>
  </div>
  <div class="clear"></div>
  
</div>