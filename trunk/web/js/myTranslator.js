var index = 0;
var indexPages = 0;

myTranslator = function(options){
  this._initialize();
}

myTranslator.instance = null;

myTranslator.getInstance = function (){
  if(myTranslator.instance == null)
    myTranslator.instance = new myTranslator();
  return myTranslator.instance;
}

myTranslator.prototype = {
  _initialize: function(){
    this.changeApp();
    this.changePages();
    this.changeLenguages();
  },
  
  changeApp: function(){
    var self = this;

    $('#application').change(function(){
      self.changeLenguage();
      self.changePages();
    });
  },
  
  changeLenguages: function(){
    var self = this;
        
    $('#base_language').change(function(){
      self.reloadTexts();
    });

    $('#language').change(function(){
      //self.reloadTexts();
      });
  },
  
  reloadTexts: function(){
    $('#datos').html('');
    this.checkByParent('app_pages');
  },
	
  changePages: function(){
    var self = this;
    //mdShowLoading();
    // __MD_CONTROLLER_SYMFONY + '/mdTranslator/getApplicationPagesAjax'
    $.ajax({
      url: $("#application_page_ajax_url").val(),
      type: 'post',
      data: {
        'app': $('#application').attr('value'), 
        'catalogue': $('#catalogue').attr('value'), 
        'lang': $('#language').attr('value')
      },
      dataType: 'json',
      success: function(json){
        //mdHideLoading();                
        self.createAppPagesDiv();
        for(var i=0;i<json.length;i++){
          self.createInput(json[i].page);
        }
      }
    });
        
  },
  
  createInput: function(text){
    var divPlace = $('#'+ $('#application').attr('value') + '_pages');
    //indexPages - variable global
    var value = "<label for='cb"+indexPages+"' class='tr_checkbox_label'><input name='checkbox[]' value='"+text+"' type='checkbox' id='cb"+indexPages+"' onclick='myTranslator.getInstance().getTexts(this);'>"+text+"</label>";
    divPlace.append(value);
    indexPages++;
  },
	
  createAppPagesDiv: function(){

    $('#app_pages').html('');
    var divPlace = $('#' + $('#application').attr('value') + '_pages');
    if(divPlace.length > 0){
      return false;
    }

    var div = "<div id='"+ $('#application').attr('value') + "_pages' class='chkListIn'></div>";
    $('#app_pages').append(div);
    return true;
  },
  
  changeLenguage: function(){
    //mdShowLoading();
    // __MD_CONTROLLER_SYMFONY + '/mdTranslator/getLangsAjax',
    $.ajax({
      url: $("#application_langs_ajax_url").val(),
      data:{
        'app': $('#application').attr('value')
      },
      type: 'post',
      dataType: 'json',
      success: function(json){
        $("#datos").html("");
        //mdHideLoading();
        var list = $('#language > option')
        var count, opt, i;
        for(count = list.length - 1; count >= 0; count--){
          list[count] = null;
        }

        for(i=0;i<json.length;i++){
          opt=document.createElement('option');
          opt.text=json[i].id;
          opt.value=json[i].id;
          list.add(opt);
        }

        var listBase=$('#base_language > option');
        for(count = listBase.length - 1; count >= 0; count--){
          listBase[count] = null;
        }

        opt=document.createElement('option');
        opt.text='';
        opt.value='';
        listBase.add(opt);
        for(i=0;i<json.length;i++){
          opt=document.createElement('option');
          opt.text=json[i].id;
          opt.value=json[i].id;
          listBase.add(opt);
        }
      }
    });

  },
  
  getTexts: function(obj){
    //this.highlight_div(obj);
    if(obj.checked){
      this.loadTextBoxes(obj.value );
    }else{
      if($(obj.value) != null){
        $('div.' + obj.value).each(function(index, element){
          var parent = $(element).prev();
          $(element).remove();
          $(parent).remove();
        });
      }
      myTranslator.getInstance().removeLoadedTexts();
    }
  },
  
  /**
     *  Recibe la pagina para la cual tiene que traer los textos,
     *  trae el box cerrado armado y lo agrega al DOM
     */
  loadTextBoxes: function(page){
    //mdShowLoading();
    url = $("#application_texts_ajax_url").val();//__MD_CONTROLLER_SYMFONY + '/'+this.module+'/getTranslationsFormsHeader';
    var self = this;
    $.ajax({
      url: url,
      data: {
        'app': $('#application').attr('value'), 
        'catalogue': $('#catalogue').attr('value'), 
        'lang': $('#language').attr('value'), 
        'page': page, 
        'index': index, 
        'baselang': $('#base_language').attr('value')
      },
      dataType: 'html',
      type: 'post',
      success: function(html){
        //mdHideLoading();
        $('#datos').append(html);
      //$(self.containerId).accordion('destroy').accordion(self.accordion_options);
      }
    });
  },
  
  loadTexts: function(element, page, full_key){
//    console.log(element);
//    console.log($(element));
//    console.log($(element).parent().addClass("tr_active"));
    myTranslator.getInstance().removeLoadedTexts();
    $(element).parent().addClass("tr_active");
    url = $("#application_text_content_ajax_url").val(); //__MD_CONTROLLER_SYMFONY + '/mdTranslator/getContentToEdit';
    var content = "#contenido";    
    //var full_key = $(content).prev('div.accordion-header').find('input.full_key').attr('value');
        
    $.ajax({
      url: url,
      data: {
        'app': $('#application').attr('value'), 
        'catalogue': $('#catalogue').attr('value'), 
        'lang': $('#language').attr('value'), 
        'full_key': full_key, 
        'key': page, 
        'base': $('#base_language').attr('value')
      },
      dataType: 'json',
      type: 'post',
      success: function(json){
        if(json.result == "true" || json.result == true)
        {
          $(content).html(json.content);
          $("#translation_form_ > textarea").cleditor({
            width:        400, // width not including margins, borders or padding
            height:       250 // height not including margins, borders or padding
          })
        }
      }
    });
    return false;
  },

  removeLoadedTexts: function(){
    var content = "#contenido";  
    $(content).empty();
    $(".tr_active").removeClass("tr_active");
    return false;
  },
  
  save: function(form, source, translation,id, selected_catalogue){
    var url = $(form).attr('action'); //__MD_CONTROLLER_SYMFONY + '/mdTranslator/changeTextAjax';
    var application = $('select:[name=application]').val();
    var lenguage = $('#language').val();
    //mdShowLoading();        
    $.ajax({
      url: url,
      data: {
        lang: lenguage, 
        catalogue: selected_catalogue, 
        app: application, 
        source: source, 
        translation: translation
      },
      dataType: 'json',
      type: 'post',
      success: function(html){
        $(".tr_active").find('.translation_text').html(html.options.message);
        /*
        mdHideLoading();                
        if(html.response == "OK"){
          place = '#result_'+id;
          //$(place).show();
          translator.updateHeader(html.options.message);
          translator.close();
          //$(place).fadeOut(3000);
          $('#message_text').show();
        }
        */
      }
    });
    return false;
  }
  
}



/**
 * 
 * Inicializo en document ready
 * 
 */

$(document).ready(function() {
  myTranslator.getInstance()._initialize();
});