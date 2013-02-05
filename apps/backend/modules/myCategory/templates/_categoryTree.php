<?php 
if(!isset($class))
  $class = "";
?>
<ul class="<?php echo $class;?>">
  <?php foreach($results as $category): ?>
  <li>
    <?php echo $category['category']->getName(); ?>
    <?php
      if(count($category['childs']) > 0):
        include_partial('categoryTree', array('results' => $category['childs']));
      endif;
    ?>
  </li>
  <?php endforeach; ?>
</ul>