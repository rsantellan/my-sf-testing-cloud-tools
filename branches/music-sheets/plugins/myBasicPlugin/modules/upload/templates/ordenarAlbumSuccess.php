<?php
  use_plugin_javascript("myBasicPlugin", "jquery-1.7.1.min.js", "first");
  use_plugin_javascript("myBasicPlugin", "jquery-ui-1.8.16.custom.min.js");
  use_plugin_stylesheet("myBasicPlugin", "le-frog/jquery-ui-1.8.16.custom.css");
  use_plugin_stylesheet("myBasicPlugin", "sortImages.css");
  use_plugin_javascript("myBasicPlugin", "sortable.js", "last");
?>

<h1><?php echo __("upload_ordenar titulo");?></h1>
<ul id="sortable">

  <?php foreach($images as $image): ?>
    <li id="listItem_<?php echo $image->getId();?>">
<!--width="150" height="150"-->
       <img  src="<?php echo $image->getUrl(array(myImageCodes::CODE => myImageCodes::RESIZECROP, myImageCodes::WIDTH => 125, myImageCodes::HEIGHT => 125));?>" />
    </li>
  <?php endforeach; ?>
</ul>
<input type="hidden" id="sort_ajax" value="<?php echo url_for("@ordenarAlbumProcesado");?>" />
<input type="hidden" id="album_id" value="<?php echo $albumId?>" />