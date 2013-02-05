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
 }
 
}