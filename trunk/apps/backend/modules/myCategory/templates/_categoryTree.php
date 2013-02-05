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
            <a href="javascript:void(0)" onclick="">Subir</a>
        <?php endif; ?>
        <?php if(count($results) > 1): ?>
            <a href="javascript:void(0)" onclick="">Bajar</a>
        <?php endif; ?>
        <?php if(count($results) > 1): ?>
            <a href="javascript:void(0)" onclick="">Ordenar Nivel</a>
        <?php endif; ?>
        <a href="javascript:void(0)" onclick="myCategoryManager.getInstance().editCategory('<?php echo url_for("@editCategory?id=".$category['category']->getId());?>', '<?php echo $category['category']->getId();?>');">Editar</a>
        <a href="javascript:void(0)" onclick="">Eliminar</a>
    </div>
    <?php
      if(count($category['childs']) > 0):
        include_partial('categoryTree', array('results' => $category['childs']));
      endif;
    ?>
  </li>
  <?php endforeach; ?>
</ul>
