<div id="global_categories_container"> 
<?php 
    include_partial("myCategoryObject/categoriesView", array("objectId" => $objectId, "objectClass" => $objectClass, "used_categories" => $used_categories, "used_categories_id" => $used_categories_id, "categories" => $categories));
?>
</div>
<input type="hidden" value="<?php echo url_for("@refreshCategoryOfObject?objectId=".$objectId."&objectClass=".$objectClass);?>" id="refresh_categories_url"/>
<?php use_plugin_javascript("myCategoryPlugin", "myCategoryObjectManager.js", "first");  ?>
