<?php
    foreach($uploades as $upload):
      ?>
  <img src="<?php echo $upload->getUrl(array(myImageCodes::CODE => 1, myImageCodes::WIDTH => 200, myImageCodes::HEIGHT => 200));?>" />
<?php    
  endforeach;
?>