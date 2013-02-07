<div class="category_object_used">
  <?php foreach($used_categories as $category):?>
    <?php var_dump($category->toArray());?>
  <?php endforeach; ?>
</div>
<hr/>
<div class="category_object_available">
  <?php include_partial('myCategoryObject/usedCategoryTree', array("objectId" => $objectId, "objectClass" => $objectClass, 'results' => $categories, 'used_categories_id' => $used_categories_id ));?>
</div>
