<?php
    $firstImage = true;
    foreach($uploades as $upload):
      ?>
<div id="album_image_<?php echo $upload->getId();?>" class="album_image">
  <div class="img_edit">
      <a href="<?php //echo site_url('upload/editFile/' . $image->id); ?>" class="fancy_link">
        Editar
      </a>
    </div>
  <img src="<?php echo $upload->getUrl(array(myImageCodes::CODE => 1, myImageCodes::WIDTH => 200, myImageCodes::HEIGHT => 200));?>" />
  <div class="img_delete">
    <a onclick="return deleteFile('<?php //echo site_url('upload/deleteFile/'.$image->id);?>', <?php //echo $image->id;?>)" href="javascript:void(0)" class="">
      <!-- <img src="<?php //echo base_url().'assets/upload/images/delete.png'?>" /> -->
      <?php echo plugin_image_tag("myBasicPlugin", "trash.png", array('alt' => __('upload_delete'))); ?>
    </a>
  </div>
</div>  
<?php    
    $firstImage = false;
  endforeach;
?>