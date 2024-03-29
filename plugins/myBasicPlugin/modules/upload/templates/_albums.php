<?php foreach($albums as $album): ?>

  <h3><?php echo $album->getTitle();?></h3>
  <div class="album_links">
    <a  class="fancy_link iframe" href="<?php echo url_for("upload/upload?i=".$album->getId()."&c=".$objectClass);?>">upload</a>
    <br/>
    <a  class="fancy_link iframe" href="<?php echo url_for("upload/ordenarAlbum?i=".$album->getId());?>">Ordenar</a>
  </div>
  <?php ?>
  <?php $uploades = myAlbumHandler::retrieveAlbumContent($album->getId());; ?>
  <div id="view_album_images_<?php echo $album->getId();?>">
    <div id="album_images_<?php echo $album->getId();?>" class="album_images">
      <div id="album_images_container_<?php echo $album->getId();?>" class="album_images_container">
        <?php include_partial("upload/albumImages", array("uploades" => $uploades)); ?>
      </div>
    </div>
  </div>
  <div id="album_slider_<?php echo $album->getId();?>"></div>
  <div class="clear"></div>
<?php endforeach;?>

<input type="hidden" value="<?php echo url_for("@reloadAlbum")?>" id="place_to_reload_albums" />

<?php 
    use_plugin_javascript("myBasicPlugin", "fancybox/jquery.fancybox-1.3.1.pack.js");
    use_plugin_javascript("myBasicPlugin", "fancybox/jquery.mousewheel-3.0.2.pack.js");
    use_plugin_stylesheet("myBasicPlugin", "../js/fancybox/jquery.fancybox-1.3.1.css");
    
    use_plugin_javascript("myBasicPlugin", "uploader.js", "last");
    use_plugin_stylesheet("myBasicPlugin", "adminAlbum.css");
?>

