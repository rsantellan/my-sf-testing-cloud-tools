<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>upload</title>
<?php 
  use_plugin_stylesheet("myBasicPlugin", "upload.css");
  use_plugin_javascript("myBasicPlugin", "FeatureDoctrine.js")
?>
<!--<link rel="stylesheet" type="text/css" href="/mdMediaManagerPlugin/css/upload.css" />-->
<!--<script type="text/javascript" src="/js/FeatureDoctrine.js"></script>-->
<?php use_stylesheets_for_form($form)?>
<?php use_javascripts_for_form($form)?>
</head> 

<body style="overflow:hidden; height:200px">

<div class="dialog">
    <div class="top">
        <div class="headline upload">
            <h2><?php echo __('uploader_text_titleUpload');?></h2>

            <p class="description"><?php echo __('uploader_text_descriptionUpload');?></p>
        </div>
    </div>
    <?php if(isset($manager)): ?>
    <div id="facts" class="facts">
        <?php echo __('uploader_text_validExtensions'); ?> <?php echo sfConfig::get('sf_plugins_upload_content_type_'.$manager->getMdObject()->getObjectClass(), '*.jpg;*.jpeg;*.gif;*.png') ?><br /><!--<?php echo __('uploader_text_maxUpload'); ?> 10 MB<br />-->
    </div>
    <?php endif; ?>
    <div id="content">

        <div id="uploadarea">
          <?php include_partial('upload/swf_single_gallery', array('album_id' => $album_id)); ?>

          <?php include_partial('upload/swf_multiple_gallery', array('form' => $form, 'album_id' => $album_id)); ?>
        </div>

    </div>
</div>

<div id="upload_container_overlay" class="upload_container" style="display:none"></div>

<div id="upload_container" class="upload_progress" style="display:none">
    <div class="progressWindow"><?php echo __('uploader_text_uploading');?>...</div>
</div>

<input type="hidden" id="upload_album_id" value="<?php echo $album_id;?>" />


</body>

</html>
