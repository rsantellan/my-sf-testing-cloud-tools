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


<a href="<?php echo url_for("upload/upload?a=".$my_test->getId()."&c=myTest");?>">upload</a>