<?php 
if(!isset($class))
  $class = "";
?>
<ul class="<?php echo $class;?>">
  <?php foreach($results as $category): ?>
  <li>
    <div class="category">
        <span class="label_name_category">
          <?php echo $category['category']->getName(); ?>
        </span>
        <a href="javascript:void(0)" onclick="return myCategoryManager.getInstance().addCategory('<?php echo url_for("@addCategory");?>', <?php echo $category['category']->getId();?>);">
          <?php echo image_tag("add.png", array("title" => __("categorias_agregar"))); ?>
        </a>
    </div>
    <?php
      if(count($category['childs']) > 0):
        include_partial('myCategoryObject/usedCategoryTree', array('results' => $category['childs'], 'used_categories_id' => $used_categories_id ));
      endif;
    ?>
  </li>
  <?php endforeach; ?>
</ul>
