<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	<?php
    
    if(!$sf_user->isAnonymous()):
    
    use_plugin_javascript("myBasicPlugin", "jquery-1.7.1.min.js", "first");  
    use_plugin_javascript("myBasicPlugin", "fancybox/jquery.fancybox-1.3.1.pack.js");
    use_plugin_javascript("myBasicPlugin", "fancybox/jquery.mousewheel-3.0.2.pack.js");
    use_plugin_stylesheet("myBasicPlugin", "../js/fancybox/jquery.fancybox-1.3.1.css");  
    
    //Esto agrega las funcionalidades del layout
    use_plugin_javascript("myBasicPlugin", "layoutOptions.js");
    
	use_plugin_stylesheet("myBasicPlugin", "admin/960.css");
	use_plugin_stylesheet("myBasicPlugin", "admin/template.css");
	use_plugin_stylesheet("myBasicPlugin", "admin/colour.css");
    
    endif;
	?>
	<?php include_stylesheets() ?>
	<?php include_javascripts() ?>
  </head>
  <body>
<?php
    if(!$sf_user->isAnonymous()):    
?>      

	<!--	Titulo-->
    <h1 id="head">Administrador</h1>
	<!--	Menu-->
	<ul id="navigation">
<!--	  <li><span class="<?php if(has_slot('home')){ echo 'active'; } ?>"><a href="<?php echo url_for("@homepage");?>">Dashboard</a></span></li>-->
	  <li><span class="<?php if(has_slot('traductor')){ echo 'active'; } ?>"><a href="<?php echo url_for("@traductor");?>"><?php echo __("traductor_titulo menu");?></a></span></li>
      <li><span class="<?php if(has_slot('usuarios')){ echo 'active'; } ?>"><a href="<?php echo url_for("@manageUsers");?>"><?php echo __("usuarios_titulo menu");?></a></span></li>
      <li><span class="<?php if(has_slot('categories')){ echo 'active'; } ?>"><a href="<?php echo url_for("@show_categories");?>"><?php echo __("categorias_titulo menu");?></a></span></li>
      <li class="right_aligned">
        <a id="fancy_link_gear" href="<?php echo url_for("myDefault/opcionesBasicas")?>">
          <?php echo plugin_image_tag("myBasicPlugin", "gear.png", array("alt" => __("opciones_mostrar"))); ?>
        </a>
      </li>
      
      
	</ul>

	<div id="content" class="container_16 clearfix">
	  
	  <div class="<?php if(has_slot('main_grid_16')){ echo 'grid_16'; } else { echo ''; } ?>">
<?php
    endif;
?>   	
		<?php echo $sf_content ?>
<?php
    if(!$sf_user->isAnonymous()):    
?>  	  
	  </div>
	</div>

	<div id="foot">
	  <a href="#">Contact Me</a>
	</div>
<?php
    endif;
?>  
  </body>
</html>
