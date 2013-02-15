<div id="detail_of_<?php echo $my_new->getId();?>">
  <div class="image_container_list">
    <?php 
          $parameters = array(myImageCodes::CODE => myImageCodes::CROPRESIZE, myImageCodes::WIDTH => 300, myImageCodes::HEIGHT => 300);
          ?>
          <img src="<?php echo myAlbumHandler::retrieveAlbumAvatarUrl("Default", $my_new->getId(), $my_new->getObjectClass(), $parameters)?>" />
  </div>
  <div class="data_container">
    <span>
      <label>Titulo</label>
      <?php echo $my_new->getTitle() ?>
    </span>
    <span>
      <label>Copete</label>
      <?php echo html_entity_decode($my_new->getCopete()) ?>
    </span>
    <span>
      <label>Body</label>
      <?php echo html_entity_decode($my_new->getBody()) ?>
    </span>
  </div>
</div>