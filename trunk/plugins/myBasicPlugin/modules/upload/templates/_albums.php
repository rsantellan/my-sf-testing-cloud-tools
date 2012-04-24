<?php foreach($albums as $album): ?>

  <h3><?php echo $album->getTitle();?></h3>
  <a  class="fancy_link iframe" href="<?php echo url_for("upload/upload?i=".$album->getId()."&c=".$objectClass);?>">upload</a>
  <br/>
  <?php $uploades = $album->getMyUploaded(); ?>
  
  <div id="album_images_<?php echo $album->getId();?>">
    <?php include_partial("upload/albumImages", array("uploades" => $uploades)); ?>
  </div>
<?php endforeach;?>

<input type="hidden" value="<?php echo url_for("@reloadAlbum")?>" id="place_to_reload_albums" />