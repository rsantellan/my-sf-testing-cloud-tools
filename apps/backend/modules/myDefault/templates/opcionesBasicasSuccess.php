<div style="height: 250px; width: 250px">
  
  <div style="text-align: center;">
	<span><?php echo __("opciones_cambiar de idioma"); ?></span>
	<br/>
	<a href="<?php echo url_for("@cambiarIdioma?idioma=es");?>">
	  <?php echo plugin_image_tag("myBasicPlugin", "uy_flag.png", array("alt" => __("opciones_español")));?>
	</a>
	<a href="<?php echo url_for("@cambiarIdioma?idioma=en");?>">
	  <?php echo plugin_image_tag("myBasicPlugin", "usa_flag.png", array("alt" => __("opciones_ingles")));?>
	</a>
	
  </div>
  <div class="clear"></div>
  <div style="text-align: center; margin-top: 16px;">
	<span><?php echo __("opciones_limpiar el cache"); ?></span>
	<br/>
    <a href="<?php echo url_for("@symfonycc");?>" onclick="return layoutOptions.getInstance().clearCache(this)">
      <?php echo plugin_image_tag("myBasicPlugin", "clean.png", array("alt" => __("opciones_limpiar cache"))); ?>
    </a>
    
  </div>
  <div class="clear"></div>
  <div style="text-align: center; margin-top: 16px;"> 
	<span><?php echo __("opciones_salir"); ?></span>
    <br/>
	<a href="<?php echo url_for("@sf_guard_signout");?>">
      <?php echo plugin_image_tag("myBasicPlugin", "logout.png", array("alt" => __("opciones_logout"))); ?>
    </a>
  </div>
  <div class="clear"></div>
  
</div>