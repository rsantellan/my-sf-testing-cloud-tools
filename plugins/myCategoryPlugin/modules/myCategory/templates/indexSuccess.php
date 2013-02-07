<?php use_plugin_javascript("myCategoryPlugin", "myCategoryManager.js", "first");  ?>
<?php
//Ingreso el slot
slot('categories', 'categories');
?>

<h3><?php echo __("categorias_titulo admin"); ?></h3>
<div class="clear"></div>
<select name="category_class" id="category_class">
  <?php 
  foreach($my_categories_classes as $a_class):
  ?>
  <option value="<?php echo $a_class->getObjectClassName();?>"><?php echo $a_class->getObjectClassName();?></option>
  <?php
  endforeach;
  ?>
</select>

<input type="button" value="<?php echo __("categorias_buscar de clase");?>" onclick="myCategoryManager.getInstance().retrieveObjectsOfClass();"/>
<div class="clear"></div>
<a href="javascript:void(0)" onclick="return myCategoryManager.getInstance().addCategory('<?php echo url_for("@addCategory");?>', null);">
  <?php echo plugin_image_tag("myCategoryPlugin", "add.png", array("title" => __("categorias_agregar hijo"))); ?>
</a>
<div class="clear"></div>

<div id="tree_container">
  
</div>

<div id="form_container">
  
</div>

<input type="hidden" value="<?php echo url_for("@retrieve_categories_of_class");?>" id="retrieve_categories_of_class_url" />