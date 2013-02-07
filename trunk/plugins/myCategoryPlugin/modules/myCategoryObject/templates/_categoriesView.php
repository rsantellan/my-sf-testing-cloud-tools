<div class="category_object_used">
  <?php foreach($used_categories as $category):?>
    <div class="category_used_container">
      <?php echo $category->getName();?>
      <a href="javascript:void(0)" onclick="return myCategoryObjectManager.getInstance().addToObject('<?php echo url_for("@removeCategoryOfObject");?>', <?php echo $objectId;?>, '<?php echo $objectClass; ?>', <?php echo $category->getId();?>);">
          <?php echo plugin_image_tag("myCategoryPlugin", "delete.png", array("title" => __("categorias_sacar del objeto"))); ?>
        </a>
    </div>
  <?php endforeach; ?>
</div>
<hr/>
<div class="category_object_available">
  <?php include_partial('myCategoryObject/usedCategoryTree', array("objectId" => $objectId, "objectClass" => $objectClass, 'results' => $categories, 'used_categories_id' => $used_categories_id ));?>
</div>
