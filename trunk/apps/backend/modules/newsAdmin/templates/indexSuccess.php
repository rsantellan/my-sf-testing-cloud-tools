<h1>My news List</h1>
<?php 
use_plugin_javascript("myBasicPlugin", "jquery.dataTables.js", "last"); 
use_plugin_stylesheet("myBasicPlugin", "jquery.dataTables.css");
?>
<table id="table">
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Copete</th>
      <th>Body</th>
      <th>Source</th>
      <th>Publish</th>
      <th>Is active</th>
      <th>Views count</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($my_news as $my_new): ?>
    <tr>
      <td>
        <a href="<?php echo url_for('newsAdmin/edit?id='.$my_new->getId()) ?>">
          <?php 
          $parameters = array(myImageCodes::CODE => myImageCodes::CROPRESIZE, myImageCodes::WIDTH => 100, myImageCodes::HEIGHT => 100);
          ?>
          <img src="<?php echo myAlbumHandler::retrieveAlbumAvatarUrl("Default", $my_new->getId(), $my_new->getObjectClass(), $parameters)?>" />
        </a>
      </td>
      <td><?php echo $my_new->getTitle() ?></td>
      <td>
        <?php echo truncate_text(html_entity_decode($my_new->getCopete())) ?>
        <div style="display:none">
          <?php echo html_entity_decode($my_new->getCopete()) ?>
        </div>
      </td>
      <td>
        <?php echo truncate_text(html_entity_decode($my_new->getBody())) ?>
        <div style="display:none">
          <?php echo html_entity_decode($my_new->getBody()) ?>
        </div>
      </td>
      <td><?php echo $my_new->getSource() ?></td>
      <td><?php echo $my_new->getPublish() ?></td>
      <td><?php echo $my_new->getIsActive() ?></td>
      <td><?php echo $my_new->getViewsCount() ?></td>
      <td>
        <a href="<?php echo url_for('newsAdmin/edit?id='.$my_new->getId()) ?>">
          Editar
        </a>
        <a class="fancy_box_link_inline" href="<?php echo url_for('newsAdmin/showDetail?id='.$my_new->getId());?>">
          Mostrar
        </a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('newsAdmin/new') ?>">New</a>

<script type="text/javascript">
$(document).ready(function() {
    $('#table').dataTable();
    $(".fancy_box_link_inline").fancybox();
} );
</script>
