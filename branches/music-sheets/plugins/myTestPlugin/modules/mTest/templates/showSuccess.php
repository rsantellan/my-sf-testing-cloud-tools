<?php 
  include_partial("upload/uploaderHeader");
?>

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

<?php include_component("upload", "albums", array('objectId' => $my_test->getId(), 'objectClass' => $my_test->getObjectClass())); ?>
<?php //$albums = myAlbumHandler::retrieveAlbumsOfObject($my_test->getId(), $my_test->getObjectClass()); ?>

<?php include_component("myCategoryObject", "categories", array('objectId' => $my_test->getId(), 'objectClass' => $my_test->getObjectClass())); ?>