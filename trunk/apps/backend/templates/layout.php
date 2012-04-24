<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	<?php
    
    if(!$sf_user->isAnonymous()):
    
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
	  <li><span class="<?php if(has_slot('home')){ echo 'active'; } ?>"><a href="<?php echo url_for("@homepage");?>">Dashboard</a></span></li>
	  <li><span class="<?php if(has_slot('traductor')){ echo 'active'; } ?>"><a href="<?php echo url_for("@traductor");?>">Textos</a></span></li>
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
