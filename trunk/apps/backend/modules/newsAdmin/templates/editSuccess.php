<h1>Edit My new</h1>

<?php include_partial('form', array('form' => $form)) ?>


<hr />

<?php include_component("upload", "albums", array('objectId' => $form->getObject()->getId(), 'objectClass' => $form->getObject()->getObjectClass())); ?>

<?php include_component("myCategoryObject", "categories", array('objectId' => $form->getObject()->getId(), 'objectClass' => $form->getObject()->getObjectClass())); ?>