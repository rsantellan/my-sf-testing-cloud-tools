myCategoryObjectManager = function(options){
  this._initialize();
}

myCategoryObjectManager.instance = null;


// myCategoryObjectManager.getInstance().refreshCategoriesOfObject();
myCategoryObjectManager.getInstance = function (){
  if(myCategoryObjectManager.instance == null)
	myCategoryObjectManager.instance = new myCategoryObjectManager();
  return myCategoryObjectManager.instance;
}

myCategoryObjectManager.prototype = {
  _initialize: function(){

 },
 
 refreshCategoriesOfObject: function()
 {
   $.ajax({
         url: $("#refresh_categories_url").val(),
         type: 'post',
         dataType: 'json',
         success: function(json){
           if(json.response == "OK")
           {
             $("#global_categories_container").html(json.options.body);
           }
         }
    });
 },
 
 addToObject: function(mUrl, objectId, objectClass, categoryId)
 {
     var self = this;
     $.ajax({
         url: mUrl,
         data: {'objectId': objectId, 'objectClass' : objectClass, 'categoryId' : categoryId },
         type: 'post',
         dataType: 'json',
         success: function(json){
           if(json.response == "OK")
           {
             self.refreshCategoriesOfObject();
             //$("#tree_container").html(json.options.body);
           }
         }
    });
 },
 
 removeOfObject: function(mUrl, objectId, objectClass, categoryId)
 {
   var self = this;
    $.ajax({
         url: mUrl,
         data: {'objectId': objectId, 'objectClass' : objectClass, 'categoryId' : categoryId },
         type: 'post',
         dataType: 'json',
         success: function(json){
           if(json.response == "OK")
           {
             self.refreshCategoriesOfObject();
             //$("#tree_container").html(json.options.body);
           }
         }
    });
 }
 
}
