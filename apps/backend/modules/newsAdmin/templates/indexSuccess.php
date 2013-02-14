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
    </tr>
  </thead>
  <tbody>
    <?php foreach ($my_news as $my_new): ?>
    <tr>
      <td><a href="<?php echo url_for('newsAdmin/edit?id='.$my_new->getId()) ?>"><?php echo $my_new->getId() ?></a></td>
      <td><?php echo $my_new->getTitle() ?></td>
      <td>
        <?php echo truncate_text($my_new->getCopete()) ?>
        <div style="display:none">
          <?php echo $my_new->getCopete() ?>
        </div>
      </td>
      <td>
        <?php echo truncate_text( $my_new->getBody()) ?>
        <div style="display:none">
          <?php echo $my_new->getBody() ?>
        </div>
      </td>
      <td><?php echo $my_new->getSource() ?></td>
      <td><?php echo $my_new->getPublish() ?></td>
      <td><?php echo $my_new->getIsActive() ?></td>
      <td><?php echo $my_new->getViewsCount() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('newsAdmin/new') ?>">New</a>

<script type="text/javascript">
$(document).ready(function() {
    $('#table').dataTable();
} );
</script>
