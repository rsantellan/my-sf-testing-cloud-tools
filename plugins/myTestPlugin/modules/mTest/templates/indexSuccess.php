<h1>My tests List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>title</th>
      <th>body</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($my_tests as $my_test): ?>
    <tr>
      <td><a href="<?php echo url_for('mTest/show?id='.$my_test->getId()) ?>"><?php echo $my_test->getId() ?></a></td>
      <td><?php echo $my_test->getTitle() ?></td>
      <td><?php echo $my_test->getBody() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('mTest/new') ?>">New</a>
