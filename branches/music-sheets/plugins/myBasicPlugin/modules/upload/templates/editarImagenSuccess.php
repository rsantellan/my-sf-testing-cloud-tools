<div class="image_edit_container">
  <div class="image_edit_container_preview">
    
    <?php if($file->isSound()): ?>
      <embed src="<?php echo $file->getUrlPathOfBrowser();?>" width="300" height="300" ></embed>
    <?php else: ?>
      <img src="<?php echo $file->getUrl(array(myImageCodes::CODE => myImageCodes::CROPRESIZE, myImageCodes::WIDTH => 300, myImageCodes::HEIGHT => 300));?>" />
    <?php endif;?>
    <br/>
    <div class="clear"></div>
    <a href="<?php echo url_for('@downloadData?id=' . $file->getId()); ?>">
        <?php echo __('upload_download');?>
    </a>
  </div>
  <div id="image_edit_container_form" class="image_edit_container_form">
    <?php include_partial("imageEditForm", array("form" => $form)); ?>
    
  </div>
  
</div>