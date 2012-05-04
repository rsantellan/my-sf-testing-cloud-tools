$(document).ready(function() { 
  
  $("a#fancy_link_gear").fancybox();

});

layoutOptions = function(options){
  this._initialize();
}

layoutOptions.instance = null;

layoutOptions.getInstance = function (){
  if(layoutOptions.instance == null)
	layoutOptions.instance = new layoutOptions();
  return layoutOptions.instance;
}

layoutOptions.prototype = {
  _initialize: function(){

 },
 
 clearCache: function(element)
 {
   //Supongo que estoy en un fancybox.
   $.fancybox.showActivity();
   $.ajax({
	  url: $(element).attr("href"),
	  dataType: 'json',
	  complete: function(json){
		//mdHideLoading();   
		$.fancybox.hideActivity();
	  }
	});
   
   return false;
 }
 
}