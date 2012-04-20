<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	<?php
	use_stylesheet("admin/960.css");
	use_stylesheet("admin/template.css");
	use_stylesheet("admin/colour.css");
	?>
	<?php include_stylesheets() ?>
	<?php include_javascripts() ?>
  </head>
  <body>
	<!--	Titulo-->
    <h1 id="head">Administrador</h1>
	<!--	Menu-->
	<ul id="navigation">
	  <?php if (true): ?>
	  <li><span class="active"><a href="<?php echo url_for("@homepage");?>">Dashboard</a></span></li>
	  <?php else: ?>
  	  <li><a href="<?php //echo site_url('admin/index'); ?>">Dashboard</a></li>
	  <?php endif; ?>
	  <li><span><a href="<?php echo 'hola';?>">Textos</a></span></li>
	</ul>

	<div id="content" class="container_16 clearfix">
	  
	  <div class="<?php if(has_slot('main_grid_16')){ echo 'grid_16'; } else { echo ''; } ?>">
	
		<?php echo $sf_content ?>
	  
	  </div>
	</div>

	<div id="foot">
	  <a href="#">Contact Me</a>
	</div>
  </body>
</html>
