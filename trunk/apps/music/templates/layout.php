<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	
	<?php
    
    if(!$sf_user->isAnonymous()):
	  
	  use_javascript("music/jquery-1.9.0.js", "first");
	  use_javascript("music/jquery-ui-1.10.0.custom.min.js", "last");
	  
	  use_stylesheet("music/jqueryui/humanity/jquery-ui-1.10.0.custom.min.css");
	  
	  
	endif;
	?>
	
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <?php echo $sf_content ?>
  </body>
</html>
