Zikula.define('Mediasharex');

document.observe("dom:loaded", function()
{
    
			Zikula.Mediasharex.Images.Listener();
			//jQuery('#logo').addClass('z-hide');
			//jQuery('#ajax_logo').removeClass('z-hide');
			//jQuery("#mediasharex_edit_img_delete").on("click",Zikula.Mediasharex.Images.Delete);
			
});

/* Image manager */
Zikula.Mediasharex.Images = 
{
    Listener: function()
    {
		    jQuery(function () {
		    'use strict';
		    // Change this to the location of your server-side upload handler:
		    var url = Zikula.Config.baseURL+'index.php?module=Mediasharex&type=ajax&func=uploadlogo';
		    
		    //alert('test');
		    
		    jQuery('#logo_upload').fileupload({
		        url: url,
		       done: function (e, data) {       				
				Zikula.Mediasharex.Images.Done(e, data);
		        },		
		progressall: function (e, data) {
				Zikula.Mediasharex.Images.Progress(e, data);
		    }
		    });
			});
    },    
    Done: function(e, data)
    {
    	
    			 jQuery('<img src="http://www.mojeleicester.pl/modules/Mediasharex/images/ajax-loader.gif">').load(function() {
		  	     jQuery("#mediasharex_edit_logo i").replaceWith(jQuery(this));				 
				 });
				 jQuery('#progress').addClass('z-hide');
               	 var files = jQuery.parseJSON( data.result );        
		         jQuery('#ajax_logo').val(files.logo_upload);
		         jQuery('<img src="http://www.mojeleicester.pl/MContent_files/Mediasharex/'+files.logo_upload+'">').load(function() {
		  	     jQuery("#mediasharex_edit_logo img").replaceWith(jQuery(this));				 
				 });
				 jQuery('#mediasharex_edit_logo_box').addClass('z-hide');
				 jQuery('#mediasharex_edit_logo_delete_box').removeClass('z-hide');
				  
    },
    Progress: function(e, data)
    {
    			jQuery('#progress').removeClass('z-hide');
    			
		        var progress = parseInt(data.loaded / data.total * 100, 10);
		        jQuery('#progress .bar').css(
		            'width',
		            progress + '%'
		        );


    },
    Delete: function(event)
    {
				 jQuery('#mediasharex_edit_logo_box').removeClass('z-hide');
				 jQuery('#mediasharex_edit_logo_delete_box').addClass('z-hide');
				 jQuery('#progress').addClass('z-hide');
				 jQuery('<i class="icon-picture icon-5x"></i>').load(function() {
		  	     jQuery("#mediasharex_edit_logo img").replaceWith(jQuery(this));				 
				 });
				 
		//quiet delete
			 				 
 		var logo_file = jQuery('#ajax_logo').val();
		
		var pars = {images: logo_file}
								
		var myAjax = new Zikula.Ajax.Request(
       	Zikula.Config.baseURL + 'ajax.php?module=Mediasharex&type=Ajax&func=deletefiles',{
       	    method: 'post',
		parameters: pars
		});
			 
				  
    }
    
    
};


        
        