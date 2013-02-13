<?php
    $firstImage = true;
    foreach($uploades as $upload):
      ?>
<div id="album_image_<?php echo $upload->getId();?>" class="album_image">
  <div class="img_edit">
      <a href="<?php echo url_for('@editarImagen?id=' . $upload->getId()); ?>" class="fancy_link">
        <?php echo __('upload_edit');?>
      </a>
    </div>
  <!-- width="200" height="200" -->
  <img width="200" height="200" src="<?php echo $upload->getUrl(array(myImageCodes::CODE => myImageCodes::CROPRESIZE, myImageCodes::WIDTH => 200, myImageCodes::HEIGHT => 200));?>" />
  
  <div class="img_avatar">
	<?php if($firstImage): ?>
	  <?php echo __('upload_avatar'); ?>
	<?php endif;?>
  </div>
  
  <div class="img_delete">
    <a onclick="return deleteFile('<?php echo url_for("@deleteFile");?>', '<?php echo __("upload_esta seguro de querer eliminar la imagen?");?>', <?php echo $upload->getId(); ?>, <?php echo $upload->getMyAlbumId(); ?>)" href="javascript:void(0)" class="">
      <?php 
		$options = array();
		$options["alt"] = __('upload_delete');
	  ?>
      <?php echo plugin_image_tag("myBasicPlugin", "trash.png", $options); ?>
    </a>
  </div>
</div>  
<?php    
    $firstImage = false;
  endforeach;
?>