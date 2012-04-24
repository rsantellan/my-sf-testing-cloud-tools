<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $my_test->getId() ?></td>
    </tr>
    <tr>
      <th>Title</th>
      <td><?php echo $my_test->getTitle() ?></td>
    </tr>
    <tr>
      <th>Body</th>
      <td><?php echo $my_test->getBody() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('mTest/edit?id='.$my_test->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('mTest/index') ?>">List</a>

<hr />
<?php $albums = myAlbumHandler::retrieveAlbumsOfObject($my_test->getId(), $my_test->getObjectClass()); ?>
<?php foreach($albums as $album): ?>

  <h3><?php echo $album->getTitle();?></h3>
  <a href="<?php echo url_for("upload/upload?i=".$album->getId()."&c=".$my_test->getObjectClass());?>">upload</a>
  <br/>
  <span>Muestro las imagenes</span>
  <?php
    $uploades = $album->getMyUploaded();
    foreach($uploades as $upload):
      ?>
  <img src="<?php echo $upload->getUrl(array(myImageCodes::CODE => 1, myImageCodes::WIDTH => 200, myImageCodes::HEIGHT => 200));?>" />
  <a href="">a</a>
  <?php    
    endforeach;
  ?>
<?php endforeach;?>
