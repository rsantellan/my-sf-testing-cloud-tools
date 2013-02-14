<h1>M songs List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Fecha publicacion</th>
      <th>Remix</th>
      <th>M group</th>
      <th>M group original</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($m_songs as $m_song): ?>
    <tr>
      <td><a href="<?php echo url_for('songs/edit?id='.$m_song->getId()) ?>"><?php echo $m_song->getId() ?></a></td>
      <td><?php echo $m_song->getName() ?></td>
      <td><?php echo $m_song->getFechaPublicacion() ?></td>
      <td><?php echo $m_song->getRemix() ?></td>
      <td><?php echo $m_song->getMGroupId() ?></td>
      <td><?php echo $m_song->getMGroupOriginalId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('songs/new') ?>">New</a>
