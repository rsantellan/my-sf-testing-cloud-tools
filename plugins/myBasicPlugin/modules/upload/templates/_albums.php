<?php foreach($albums as $album): ?>

  <h3><?php echo $album->getTitle();?></h3>
  <a  class="fancy_link iframe" href="<?php echo url_for("upload/upload?i=".$album->getId()."&c=".$objectClass);?>">upload</a>
  <br/>
  <?php $uploades = $album->getMyUploaded(); ?>
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