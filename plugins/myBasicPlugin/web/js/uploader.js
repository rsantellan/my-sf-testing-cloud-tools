$(document).ready(function() { 
  
  $("a.fancy_link").fancybox();
  initializaseAllAlbums();
  hoversImages();
});

function reloadAlbum(id)
{
  var url = $("#place_to_reload_albums").val();
  $.ajax({
      url: url,
      data: {
          'id': id
      },
      type: 'post',
      dataType: 'json',
      success: function(json){
          if(json.response == "OK")
          {
            $("#album_images_container_"+id).html(json.options.body);
            restartSlider(id);
            hoversImages();
          }
      }, 
      complete: function()
      {

      }
  });
}

var listOfAlbumSliders = new Array();

function initializaseAllAlbums()
{
  //console.log(listOfAlbumSliders);
  $(".album_images_container").each(function(index, item){
    //console.log(index);
    //console.log(item);
    var currentId = $(item).attr('id');
    var id = currentId.replace("album_images_container_","");
    
    startAlbumSlider(id);
  });
  //console.log(listOfAlbumSliders);
}

function restartSlider(id)
{
  listOfAlbumSliders[parseInt(id)].slider( "destroy" );
  startAlbumSlider(id);
}

function startAlbumSlider(id)
{
  //console.log(id);
  //vars
  var conveyor = $("#album_images_container_"+id), item = $(".album_image", $("#album_images_container_"+id));
  //console.log(conveyor);
  //console.log(item);
  //set length of conveyor
  
  conveyor.css("width", item.length * parseInt(item.css("width")));
  //config
  var myMax = parseInt((item.length * parseInt(item.css("width"))) - parseInt($("#view_album_images_"+id).css("width")));
  
  var sliderOpts = {
    max: myMax,
    slide: function(event, ui) {
      conveyor.css("left", "-" + ui.value + "px");
    }
  };
  //create slider
  var scrollbar = $("#album_slider_"+id).slider(sliderOpts);
  listOfAlbumSliders[parseInt(id)] = scrollbar;
  return false;
}

function hoversImages()
{
  $('.album_image').each(function(index, value) {
    $(this).hover(function(){
      $(this).find('div.img_edit').show();
      $(this).find('div.img_delete').show();
    },
    function(){
      $(this).find('div.img_edit').hide();
      $(this).find('div.img_delete').hide();
    });
  });
  
}

function deleteFile(mUrl, text, itemId, albumId)
{
  if(confirm(text))
  {
    $.ajax({
      url: mUrl,
      data: {
          'id': id
      },
      type: 'post',
      dataType: 'json',
      complete: function(json)
      {
        if(json.response == "OK")
        {
          $('#album_image_' + itemId).fadeOut(500, function() {$(this).remove();});
          restartSlider(albumId);
          hoversImages();
        }
      }        
    });    
  }

}