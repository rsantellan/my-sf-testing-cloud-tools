<h1>Edit M song</h1>

<?php include_partial('form', array('form' => $form)) ?>


<?php 
$object = $form->getObject();
include_component("upload", "albums", array('objectId' => $object->getId(), 'objectClass' => $object->getObjectClass())); 

?>