<?php use_javascript("myCategoryManager.js"); ?>

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

<input type="button" value="<?php echo __("categorias_buscar de clase");?>" onclick="myCategoryManager.getInstance().retrieveObjectsOfClass('<?php echo url_for("@retrieve_categories_of_class");?>');"/>

<div id="tree_container">
  
</div>

<div id="form_container">
  
</div>
