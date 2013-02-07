myCategoryObjectManager = function(options){
  this._initialize();
}

myCategoryObjectManager.instance = null;

myCategoryObjectManager.getInstance = function (){
  if(myCategoryObjectManager.instance == null)
	myCategoryObjectManager.instance = new myCategoryObjectManager();
  return myCategoryObjectManager.instance;
}

myCategoryObjectManager.prototype = {
  _initialize: function(){

 },
 
 addToObject: function(mUrl, objectId, objectClass, categoryId)
 {
     console.info(mUrl);
     console.info(objectId);
     console.info(objectClass);
     console.info(categoryId);
     $.ajax({
         url: mUrl,
         data: {'objectId': objectId, 'objectClass' : objectClass, 'categoryId' : categoryId },
         type: 'post',
         dataType: 'json',
         success: function(json){
           if(json.response == "OK")
           {
             //$("#tree_container").html(json.options.body);
           }
         }
    });
 }
 
}
