myCategoryManager = function(options){
  this._initialize();
}

myCategoryManager.instance = null;

myCategoryManager.getInstance = function (){
  if(myCategoryManager.instance == null)
	myCategoryManager.instance = new myCategoryManager();
  return myCategoryManager.instance;
}

myCategoryManager.prototype = {
  _initialize: function(){

 },
 
 retrieveObjectsOfClass: function(mUrl)
 {
   $.ajax({
     url: mUrl,
     data: {'objectClass': $("#category_class").val() },
     type: 'post',
     dataType: 'json',
     success: function(json){
       if(json.response == "OK")
       {
         $("#tree_container").html(json.options.body);
       }
     }
   });
 },
 
 editCategory: function(mUrl, categoryId)
 {
     console.info(mUrl);
     console.info(categoryId);
     $.ajax({
     url: mUrl,
     type: 'post',
     dataType: 'json',
     success: function(json){
       if(json.response == "OK")
       {
         $("#form_container").html(json.options.body);
       }
     }
   });
 },
 
 saveForm: function(form)
 {
     $.ajax({
          url: $(form).attr('action'),
          data: $(form).serialize(),
          type: 'post',
          dataType: 'json',
          success: function(json){
              
            }
          });
     
     return false;
     
 }
 
}
