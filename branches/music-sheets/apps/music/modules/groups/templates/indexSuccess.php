<h1>M groups List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($m_groups as $m_group): ?>
    <tr>
      <td><a href="<?php echo url_for('groups/edit?id='.$m_group->getId()) ?>"><?php echo $m_group->getId() ?></a></td>
      <td><?php echo $m_group->getName() ?></td>
      <td><?php echo $m_group->getDescription() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('groups/new') ?>">New</a>
