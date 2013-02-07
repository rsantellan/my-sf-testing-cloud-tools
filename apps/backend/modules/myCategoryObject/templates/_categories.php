<div id="global_categories_container"> 
<?php 
    include_partial("myCategoryObject/categoriesView", array("objectId" => $objectId, "objectClass" => $objectClass, "used_categories" => $used_categories, "used_categories_id" => $used_categories_id, "categories" => $categories));
?>
</div>
<?php use_javascript("myCategoryObjectManager.js", "last");?>
