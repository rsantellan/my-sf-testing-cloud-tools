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
        <a href="javascript:void(0)" onclick="return myCategoryObjectManager.getInstance().addToObject('<?php echo url_for("@addCategoryToObject");?>', <?php echo $objectId;?>, '<?php echo $objectClass; ?>', <?php echo $category['category']->getId();?>);">
          <?php echo plugin_image_tag("myCategoryPlugin", "add.png", array("title" => __("categorias_agregar"))); ?>
        </a>
    </div>
    <?php
      if(count($category['childs']) > 0):
        include_partial('myCategoryObject/usedCategoryTree', array("objectId" => $objectId, "objectClass" => $objectClass, 'results' => $category['childs'], 'used_categories_id' => $used_categories_id ));
      endif;
    ?>
  </li>
  <?php endforeach; ?>
</ul>
