<form method="POST" action="<?php echo url_for("@moveDownCategory");?>" onsubmit="return myCategoryManager.getInstance().saveSiblingForm(this);">
  <select name="category_parent_id">
    <?php foreach($categories as $category): ?>
      <option value="<?php echo $category->getId();?>"><?php echo $category->getName();?></option>
    <?php endforeach; ?>
  </select>
  <input type="hidden" value="<?php echo $categoryId;?>" name="categoryId" />
  <div class="clear"></div>
  <input type="button" value="<?php echo __('categorias_cancelar');?>" onclick="myCategoryManager.getInstance().cancelForm();" />
  <input type="submit" value="<?php echo __('categorias_salvar');?>" />
</form>