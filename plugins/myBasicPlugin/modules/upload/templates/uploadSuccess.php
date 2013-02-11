<?php
$max_size = ini_get('upload_max_filesize');

    include_component('upload', 'uploader', array(
      'upload_url'        => url_for('upload/uploadContent?'. ini_get('session.name') . '=' . session_id() . '&upload=framework'),     //ruta al action que procesa la imagen y la sube
      'file_types'        => $allowed_types,  //formatos soportados
      'upload_max_filesize' => $max_size,       //peso en bites máximo para cada imagen
      'file_upload_limit' => 0,                           //cantidad de archivos máximo que podemos subir
      'file_queue_limit'  => 0,                           //
      'progress_style'    => sfConfig::get( 'sf_plugins_upload_javascript_type_' . $objectClass, 'swfupload-progressFile' ), //     //javascript que dibuja el contenedor de imagenes subidas y thumbnails
      'post_params'       => '"h": 70,"w":70, "album_id":'.$album_id.',"objClass":"' . $objectClass . '"',            //altura y ancho que queremos mostrar el thumb de cada imagen
      'upload_browse'     => '<div id="image-browse" class="addbutton">' . __('upload_uploadFile').'</div>',  //diseño que mostramos el boton de subir, debe mantenerse el id default
      'album_id'          => $album_id
    ))
?>
