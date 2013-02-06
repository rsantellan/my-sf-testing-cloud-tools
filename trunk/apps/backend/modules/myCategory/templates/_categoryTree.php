<?php 
if(!isset($class))
  $class = "";
?>
<ul class="<?php echo $class;?>">
  <?php foreach($results as $category): ?>
  <li>
    <div class="category">
        <?php echo $category['category']->getName(); ?>
        <?php if(!is_null($category['category']->getMyCategoryParentId())): ?> 
            <a href="javascript:void(0)" onclick="return myCategoryManager.getInstance().moveUpCategory('<?php echo url_for("@moveUpCategory?id=".$category['category']->getId());?>');"><?php echo __("categorias_subir")?></a>
        <?php endif; ?>
        <?php if(count($results) > 1): ?>
            <a href="javascript:void(0)" onclick="return myCategoryManager.getInstance().bringSiblingsCategory('<?php echo url_for("@bringSiblingsCategory?id=".$category['category']->getId());?>');"><?php echo __("categorias_bajar")?></a>
        <?php endif; ?>
        <?php if(count($results) > 1): ?>
            <a href="javascript:void(0)" onclick="">Ordenar Nivel</a>
        <?php endif; ?>
        <a href="javascript:void(0)" onclick="myCategoryManager.getInstance().editCategory('<?php echo url_for("@editCategory?id=".$category['category']->getId());?>', '<?php echo $category['category']->getId();?>');"><?php echo __("categorias_editar")?></a>
        <a href="javascript:void(0)" onclick="myCategoryManager.getInstance().deleteCategory('<?php echo url_for("@deleteCategory?id=".$category['category']->getId());?>', '<?php echo __("categorias_eliminar_confirmacion")?>');"><?php echo __("categorias_eliminar")?></a>
        <a href="javascript:void(0)" onclick="return myCategoryManager.getInstance().addCategory('<?php echo url_for("@addCategory");?>', <?php echo $category['category']->getId();?>);"><?php echo __("categorias_agregar hijo")?></a>
    </div>
    <?php
      if(count($category['childs']) > 0):
        include_partial('categoryTree', array('results' => $category['childs']));
      endif;
    ?>
  </li>
  <?php endforeach; ?>
</ul>
