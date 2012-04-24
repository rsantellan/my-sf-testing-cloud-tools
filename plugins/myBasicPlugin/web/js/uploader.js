$(document).ready(function() { 
  
  $("a.fancy_link").fancybox();
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
            $("#album_images_"+id).html(json.options.body);
          }
      }, 
      complete: function()
      {

      }
  });
}