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
 
 retrieveObjectsOfClass: function()
 {
   $.ajax({
     url: $('#retrieve_categories_of_class_url').val(),
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
 
 addCategory: function(mUrl, parentId)
 {
   $.ajax({
     url: mUrl,
     type: 'post',
     data: {'objectClass': $("#category_class").val(), 'parentId': parentId },
     dataType: 'json',
     success: function(json){
       if(json.response == "OK")
       {
         $("#form_container").html(json.options.body);
       }
     }
   });
 },
 
 editCategory: function(mUrl, categoryId)
 {
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
     var self = this;
     $.ajax({
          url: $(form).attr('action'),
          data: $(form).serialize(),
          type: 'post',
          dataType: 'json',
          success: function(json){
              if(json.response == "OK")
              {
                self.retrieveObjectsOfClass();
                self.cancelForm();
              }
              else
              {
                $("#form_container").html(json.options.body);
              }
              
            }
          });
     
     return false;
 },
 
 cancelForm: function()
 {
   $("#form_container").empty();
 },
 
 deleteCategory: function(mUrl, confirmation)
 {
   if(confirm(confirmation))
   {
     var self = this;
     $.ajax({
        url: mUrl,
        type: 'post',
        dataType: 'json',
        success: function(json){
            if(json.response == "OK")
            {
              self.retrieveObjectsOfClass();
            }
          }
      });
   }
 },
 
 moveUpCategory: function(mUrl)
 {
   var self = this;
   $.ajax({
       url: mUrl,
       type: 'post',
       dataType: 'json',
       success: function(json){
           if(json.response == "OK")
           {
             self.retrieveObjectsOfClass();
           }
         }
     });
  },
  
  bringSiblingsCategory: function(mUrl)
  {
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
  
  saveSiblingForm: function(form)
  {
     var self = this;
     $.ajax({
          url: $(form).attr('action'),
          data: $(form).serialize(),
          type: 'post',
          dataType: 'json',
          success: function(json){
              if(json.response == "OK")
              {
                self.retrieveObjectsOfClass();
                self.cancelForm();
              }
              else
              {
                $("#form_container").html(json.options.body);
              }
              
            }
          });
     
     return false;
  }
}
