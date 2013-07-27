Zikula.define('Mediasharex');

document.observe("dom:loaded", function()
{
 
Zikula.Mediasharex.Edit.Init(); 
 
			
});


        
Zikula.Mediasharex.Edit = 
{
    Init: function()
    {
    	var content = jQuery('#content').val();
    	//alert(content);
    	//if(content == ''){  
    	//jQuery('#mediasharex_edit_extendeddesc').addClass('z-hide');
    	//}else{
    	//jQuery('#mediasharex_edit_extendeddesc').addClass('z-hide');	
    	//Zikula.Mediasharex.Edit.AddExtended;	
    	//};
    	jQuery('#mediasharex_edit_options_box').addClass('z-hide');
    	Zikula.Mediasharex.Edit.AddOptions;

    	//jQuery("#mediasharex_edit_extdesc_add").on("click",Zikula.Mediasharex.Edit.AddExtended);
		jQuery("#mediasharex_edit_options_add").on("click",Zikula.Mediasharex.Edit.AddOptions);
		jQuery("#title").on("focusout", Zikula.Mediasharex.Edit.CheckTitle);
		

    	    	
    },    
    AddExtended: function()
    {
    	if (jQuery('#mediasharex_edit_extendeddesc').hasClass('z-hide')){
    		jQuery('#mediasharex_edit_extendeddesc').removeClass('z-hide');
    	
    		if(!xinha_editors.content){
    		xinha_editors = [ 'content' ];
			xinha_config = null;
			xinha_init();	
         	};	
    	} else {
    		
    		jQuery('#mediasharex_edit_extendeddesc').addClass('z-hide');
    	} 	   	
    },    
    AddOptions: function()
    {
    	if (jQuery('#mediasharex_edit_options_box').hasClass('z-hide')){
    		jQuery('#mediasharex_edit_options_box').removeClass('z-hide');
    	} else {
    		jQuery('#mediasharex_edit_options_box').addClass('z-hide');
    	} 	   	
    },    
    CheckTitle: function()
    {
    	
    	var currentshorturl = jQuery('#urltitle').val();	
    	
    	if(!currentshorturl){
			var title = jQuery('#title').val();		
			var pars = {title: title}
			
			jQuery('#mediasharex_edit_title_error').remove();
									
			var myAjax = new Zikula.Ajax.Request(
	       	Zikula.Config.baseURL + 'ajax.php?module=Mediasharex&type=Ajax&func=checktitle',{
	       	    method: 'post',
			parameters: pars,
			onComplete: function(data) {
						var json = data.responseText.evalJSON();
							if(json.data.check){
							jQuery('#urltitle').val(json.data.urltitle);	
							}else{
							jQuery('.mediasharex_edit_title').after('<div id="mediasharex_edit_title_error" class="z-errormsg">This title is taken</p>');	
							}
						}
			}); 
		};				   	
    },    
    EditorAdd: function()
    {	

    },    
    EditorRemove: function()
    {
   	
    } 
      
};        