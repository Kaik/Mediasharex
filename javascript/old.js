    EditorInit: function()
    {
   	
    
      xinha_editorsarray = 'content';

	  Xinha.loadPlugin('CharacterMap', function (){} );

      xinha_config = new Xinha.Config();
      xinha_config.width  = '750px';
      xinha_config.height = '400px';
      xinha_config.charSet = 'pl';
      xinha_config.baseURL = Zikula.Config.baseURL+'/';
      xinha_config.browserQuirksMode = false;
      xinha_config.stripBaseHref = true;
      xinha_config.killWordOnPaste = true;
      xinha_config.flowToolbars = true;
      xinha_config.stripSelfNamedAnchors = false;
      xinha_config.stripScripts = true;
      xinha_config.sizeIncludesBars = true;
      xinha_config.pageStyleSheets = [Zikula.Config.baseURL+'/modules/Scribite/style/xinha/editor.css'];
      xinha_config.statusBar = true;
      xinha_config.showLoading = false;
      xinha_config.convertUrlsToLinks = true;
      xinha_config.pageStyle = '';    
    
    
    
      xinha_config.toolbar =
    [
      ["popupeditor","bold","italic","underline","insertorderedlist","insertunorderedlist","createlink","insertimage","htmlmode"]
    ];
    
      xinha_editors   = Xinha.makeEditors(xinha_editors, xinha_config, xinha_plugins);
      Xinha.startEditors(xinha_editors);	
    } 
$("#form_oferta").submit(function(event) { 
                    var dados = $( form ).serialize(); 
                    $.ajax({  
                        type: "POST", 
                        contentType:attr( "enctype", "multipart/form-data" ),
                        url: "<?php echo site_url(); ?>adm/oferta_insert",  
                        data: dados,  
                        success: function( data )  
                        {  
                            alert( data );  
                        }  
                    });  
              
                    return false;  
                } 






jQuery(document).ready(function () {

    jQuery( "#dialog" ).dialog({
       		autoOpen: false,
 			position: { my: "top", at: "center", of: "#floatheader" },
 			open: function (event, ui) { jQuery( "#dialog").css('overflow', 'hidden'); },
 			height: 'auto',
       		  close : function(event, ui) {
      					jQuery("#dialog").empty();
   						}   		
       	 });
       	 
    jQuery(".action_preview").click(viewitem);
//    jQuery("#forum-subscription").click(modifyForum);       	 
    jQuery(".action_edit").click(edititem);   	 
    jQuery(".action_img").click(getitemimg);   	 
    jQuery(".action_delete").click(deleteitem);   	 
  	jQuery(".action_online").click(online);
  	
  	
  	jQuery('.z-form').on("submit", function(event) {
						
		event.preventDefault();
						
						//for(var key in event.target) {
    					//alert('key: ' + key + '\n' + 'value: ' + event.target[key]);
						//}
						
						//var submit = event.target.value; 
						//alert(submit);
						//FormDoPostBack();
   								    								 								  								
  		var formid = jQuery(".z-form").attr("id");
  								
  		alert(formid);
  								  								  								
  								//submitHandler(formid);
		});	
});	




//view order
 function viewitem(e) {
 	
 	
			var elementId = jQuery(this).attr('id');
			var vars    = elementId.split('_');					
			var objId = vars[1];
			var pars = "module=Mediasharex&type=ajax&func=display&id=" + objId;
			
			var myAjax = new Zikula.Ajax.Request(
       		Zikula.Config.baseURL + 'ajax.php',{
       			method: 'get',
				parameters: pars,
       			onComplete: function(data) {
					
			var json = data.responseText.evalJSON();
					
				if(json.data.result){
					jQuery( "#dialog" ).append( json.data.result );	
				}else{
					jQuery( "#dialog" ).append('Error!');	
				}
			
			//jQuery( "#dialog" ).dialog( "close" );
			}	
			});
			
			
			
			
	
			//new Ajax.Updater('dialog', document.location.pnbaseURL + 'ajax.php', 	{	
			//	method: 'get',
			//	parameters: pars
				// onSuccess: function(transport){
     			//var json = transport.responseText.evalJSON();
   				//}
				//onComplete: myFunctionResponse 
                                //var formhtml = req.responseText;
                				//alert(formhtml.toSource());    
								//$('dialog').insert(formhtml);
			//	});
				
				
			//function myFunctionResponse (req) {
			//if (req.status != 200) {
			//	showajaxerror(req.responseText);
			//return;
			//}
			//var json = pndejsonize(req.responseText);
			//if (json.alerttext != '') {
			//alert(json.alerttext);
			//}
			//};

			jQuery( "#dialog" ).dialog( "option", "width", 980 );
			jQuery( "#dialog" ).dialog( "option", "title", "Preview" );
			//jQuery( "#dialog" ).append( pars );									
		//	jQuery( "#dialog" ).load('ajax.php?module=Dizkus&func=newposts');						
	    	jQuery( "#dialog" ).dialog( "open" );




};


//view order
 function edititem(e) {
 	
				
			var elementId = jQuery(this).attr('id');
			var vars    = elementId.split('_');					
			var objId = vars[1];
			var pars = "module=Mediasharex&type=Ajax&func=modify&id=" + objId;
			
			var myAjax = new Zikula.Ajax.Request(
       		Zikula.Config.baseURL + 'ajax.php',{
       			method: 'get',
				parameters: pars,
       			onComplete: function(data) {
					
				var json = data.responseText.evalJSON();
					
				if(json.data.result){

					$( 'dialog' ).update(json.data.result);

					//jQuery( "#dialog" ).html( json.data.result );
					
					//var formid = jQuery(json.data.result).filter("form[class='.z-form']").attr("id");
															
				}else{
					jQuery( "#dialog" ).append('Error!');	
				}
			
			//jQuery( "#dialog" ).dialog( "close" );
			}	
			});

			jQuery( "#dialog" ).dialog( "option", "width", 980 );
			jQuery( "#dialog" ).dialog( "option", "title", "Edit" );
			//jQuery( "#dialog" ).append( pars );									
		//	jQuery( "#dialog" ).load('ajax.php?module=Dizkus&func=newposts');						
	    	jQuery( "#dialog" ).dialog( "open" );
			
			//alert('dziala' + formid);
			//return flase;
			//jQuery(".z-form").attr("id"); 
			//var action = "module=Mediasharex&type=Ajax&func=modify";
			//jQuery('.z-form').on("submit", function(event) {
  			//event.preventDefault();
  			//jQuery(".z-form").attr("id");
			//alert('dziala' + formid);
			//});
			
			//var elements = jQuery("#form__id").on.val();
			// document.getElementsByClassName("z-form");	
			//$(document).on("click", "a.offsite", function(){ alert("Goodbye!"); }); 				
			//var formid = jQuery(".z-form").attr('id');
			//jQuery(".z-form").submit(submitHandler(event));
			


};


 function submitHandler(formid) {
        
		//event.preventDefault();
        //Zikula.Clip.Ajax.Busy = true;
        //this.showIndicator();
        
        //var item = form;

        
        //$(formid).action;
        
        //var submit = event.findElement();
        //var form = document.getElementById(formid);
		
		//alert($(formid).action);
		//return false;

		
        //$(formid).select('input[type=submit]').each(function(e) {
         //   if (e != submit) {
         //       e.disable();
         //   }
        //});
        
        
 		//$(formid).FormEventTarget.value = 'plg10_save';
        
        //$(formid).FormEventArgument.value = 'save';
        
        
              
               
        var myAjax2 = new Zikula.Ajax.Request(
            $(formid).action,
            {
                method: 'post',
                parameters: $(formid).serialize(),
                onComplete: function(data) {
					
				var json = data.responseText.evalJSON();
					
				if(json.data.result){
					$( 'dialog' ).update(json.data.result);
					//jQuery('.z-form').on("submit", function(event) {
  					//	event.preventDefault();
  					//	submitHandler($(this));
					//	});	
										
				}else{
					jQuery( "#dialog" ).append('Error!');	
				}
			
			//jQuery( "#dialog" ).dialog( "close" );
			}
            });

        //form.select('input[type=submit]').invoke('enable');
	
};


//view order
 function getitemimg(e) {
 	
 	
			var elementId = jQuery(this).attr('id');
			var vars    = elementId.split('_');					
			var objId = vars[1];
			var pars = "module=Mediasharex&type=Ajax&func=display&id=" + objId;
	
			new Ajax.Updater('dialog', document.location.pnbaseURL + 'ajax.php', 	{	
				method: 'get',
				parameters: pars,
				onComplete: function(req) {
                                var formhtml = req;
				$('dialog').insert(formhtml);
				}});

			jQuery( "#dialog" ).dialog( "option", "width", 980 );
			jQuery( "#dialog" ).dialog( "option", "title", "Preview" );
			//jQuery( "#dialog" ).append( pars );									
		//	jQuery( "#dialog" ).load('ajax.php?module=Dizkus&func=newposts');						
	    	jQuery( "#dialog" ).dialog( "open" );




};


//view order
 function deleteitem(e) {
 	
 	
			var elementId = jQuery(this).attr('id');
			var vars    = elementId.split('_');					
			var objId = vars[1];
			var pars = "module=Mediasharex&type=Ajax&func=display&id=" + objId;
	
			new Ajax.Updater('dialog', document.location.pnbaseURL + 'ajax.php', 	{	
				method: 'get',
				parameters: pars,
				onComplete: function(req) {
                                var formhtml = req;
				$('dialog').insert(formhtml);
				}});

			jQuery( "#dialog" ).dialog( "option", "width", 980 );
			jQuery( "#dialog" ).dialog( "option", "title", "Preview" );
			//jQuery( "#dialog" ).append( pars );									
		//	jQuery( "#dialog" ).load('ajax.php?module=Dizkus&func=newposts');						
	    	jQuery( "#dialog" ).dialog( "open" );




};

//view order
 function online(e) {
 	
 			var elementId = jQuery(this).attr('id');
			var vars    = elementId.split('_');					
			var id = vars[1];	
 		
 		
 			
 		var execute = function() {
			var myAjax = new Zikula.Ajax.Request(
       		Zikula.Config.baseURL + 'ajax.php?module=Mediasharex&type=Ajax&func=setonline&id=' + id,{onComplete: function(data) {
			var json = data.responseText.evalJSON();
			if(json.data.online){
			$('recivedimg_' + id).src = '/modules/Mediasharex/images/green.gif';	
			}else{
			$('recivedimg_' + id).src = '/modules/Mediasharex/images/red.gif';	
			}
			jQuery( "#dialog" ).dialog( "close" );
			}	
			});
		}
		var cancel = function() {
		jQuery( "#dialog" ).dialog( "close" );
		}
		var dialogOpts = {
		buttons: {
			"Ok": execute,
			"Cancel": cancel
		}
		};
	
	    jQuery("#dialog").dialog(dialogOpts);
 						
 			/*
			var elementId = jQuery(this).attr('id');
			var vars    = elementId.split('_');					
			var objId = vars[1];
			var pars = "module=Mediasharex&type=Ajax&func=display&id=" + objId;
	
			new Ajax.Updater('dialog', document.location.pnbaseURL + 'ajax.php', 	{	
				method: 'get',
				parameters: pars,
				onComplete: function(req) {
                                var formhtml = req;
				$('dialog').insert(formhtml);
				}});
				
	
					*/
			jQuery( "#dialog" ).dialog( "option", "width", 280 );
			jQuery( "#dialog" ).dialog( "option", "title", "Confirm change" );
			//jQuery( "#dialog" ).append( pars );									
		//	jQuery( "#dialog" ).load('ajax.php?module=Dizkus&func=newposts');						
	    	jQuery( "#dialog" ).dialog( "open" );




};


/*


(function ($) {
    $(document).ready(function(){
       	$( "#dialog" ).dialog({
       		autoOpen: false,
       		  close : function(event, ui) {
      					$("#dialog").empty();
   						}   		
       	 });
		
				
		$( ".action_preview" ).click(function(event) {
			event.preventDefault();
			var elementId = $(this).attr('id');
			var vars    = elementId.split('_');
			
      		var pars = {id: vars[1]}
                          
        	var request = $.ajax({
	          		 url: Zikula.Config.baseURL + "wiadomosci/ajax/display",
	          		type: "POST",
	          		data: pars,
	          	dataType: "html"
        	});
        
        request.done(function(msg) {
			
			$( "#dialog" ).dialog( "option", "title", "Preview" );
			$( "#dialog" ).append( msg );									
		//	$( "#dialog" ).load('ajax.php?module=Dizkus&func=newposts');						
	    	$( "#dialog" ).dialog( "open" );
	    });
        
        request.fail(function(jqXHR, textStatus) {
			$( "#dialog" ).append('<p>Failed</p>');	
						
		  	$( "#dialog" ).dialog( "open" );
        });			
			
		
		});
     
		$( ".action_online" ).click(function() {
			
			var elementId = $(this).attr('id');
			var vars    = elementId.split('_');
			
			$( "#dialog" ).dialog( "option", "title", "Change online state" );			
			$( "#dialog" ).append('<p>'+ vars[1] +'</p>');	
						
		  	$( "#dialog" ).dialog( "open" );
		
			});


		$( ".action_img" ).click(function() {
			
			var elementId = $(this).attr('id');
			var vars    = elementId.split('_');
			
			$( "#dialog" ).dialog( "option", "title", "Img" );			
			$( "#dialog" ).append('<p>'+ vars[1] +'</p>');	
						
		  	$( "#dialog" ).dialog( "open" );
		
			});

		$( ".action_edit" ).click(function() {
			
			var elementId = $(this).attr('id');
			var vars    = elementId.split('_');
			
			$( "#dialog" ).dialog( "option", "title", "Edit" );			
			$( "#dialog" ).append('<p>'+ vars[1] +'</p>');	
						
		  	$( "#dialog" ).dialog( "open" );
		
			});
			
		$( ".action_delete" ).click(function() {
			
			var elementId = $(this).attr('id');
			var vars    = elementId.split('_');
			
			$( "#dialog" ).dialog( "option", "title", "Delete" );			
			$( "#dialog" ).append('<p>'+ vars[1] +'</p>');	
						
		  	$( "#dialog" ).dialog( "open" );
		
			});

   });  
})(jQuery)
*/



Zikula.define('Mediasharex');

document.observe("dom:loaded", function()
{
    //Zikula.Mediasharex.TreeSortable.trees.grouptypesTree.config.onSave = Zikula.Mediasharex.Resequence.Listener;

    Zikula.Mediasharex.Container.register();

    Zikula.UI.Tooltips($$('.tree a'));

    // group buttons
    
  //$('action').observe('click', function(e) {
  //    e.findElement('a').insert({after: Zikula.Mediasharex.Indicator()});
  //    e.preventDefault();
     // Zikula.Mediasharex.MenuAction(node, 'modify');
   ///});
    
  //$('action').observe(
  //  $('groupExpand').observe('click', function(e) {
   //     e.preventDefault();
   //     Zikula.Mediasharex.TreeSortable.trees.grouptypesTree.expandAll();
    //});
    //$('groupCollapse').observe('click', function(e) {
    //    e.preventDefault();
    //    Zikula.Mediasharex.TreeSortable.trees.grouptypesTree.collapseAll();
   // });

    //$('groupControls').removeClassName('z-hide');

    //Zikula.Mediasharex.AttachMenu();

    //hash behaviors
    Event.observe(window, 'hashchange', Zikula.Mediasharex.Hash.Listener)

    Zikula.Mediasharex.Hash.Listener();
});


/* Hash manager */
Zikula.Mediasharex.Hash = 
{
    Listener: function()
    {
        if (Zikula.Mediasharex.Ajax.Busy || window.location.hash.empty() || window.location.hash == '#') {
            return;
        }

        var hash = window.location.hash;
        var args = hash.replace('#', '').split('/');
        var pars = {'id': args[0]};
        var func = (typeof args[1] != 'undefined') ? args[1] : null;
        // additional parameters
        if (args.size() > 2 && args.size() % 2 == 0) {
            for (var i = 2; i < args.size(); i = i+2) {
                var key = args[i];
                pars[key] = args[i+1];
            }
        }

        Zikula.Mediasharex.Ajax.Request(pars, func)
    },

    Update: function(pars, func)
    {
        Zikula.Mediasharex.Ajax.Busy = true;

        var newhash = '';
        for (var i in pars) {
            if (i != 'id') {
                newhash += '/'+i+'/'+pars[i];
            }
        }

        newhash = pars.id+'/'+func+newhash;

        window.location.hash = newhash;
    }
};

Zikula.Mediasharex.Container = Class.create(
{
    initialize: function(options)
    {
        this.indicatorEffects = {
            fade: false,
            appear: false
        };
        //options
        this.options = Object.extend({
            indicator: false,
            sidecol: null,
            content: null,
            fade: true,
            fadeDuration: 0.75
        }, options || {});

        this.indicator = this.options.indicator ? $(this.options.indicator) : $('mediasharex_indicator');
       // this.sidecol   = this.options.sidecol ? $(this.options.sidecol) : $('clip_cols_sidecol');
        this.content   = this.options.content ? $(this.options.content) : $('dialog');
    },

    updateHeights: function()
    {
        window.setTimeout(function() {
            //this.content.removeAttribute('style');
            //this.sidecol.removeAttribute('style');
            //var max = Math.max(300, this.content.getHeight(), side = this.sidecol.getHeight());
            //this.content.setAttribute('style', "min-height: "+max+"px");
            //this.sidecol.setAttribute('style', "min-height: "+max+"px");
        }.bind(this), 150);
    },

    updateContent: function(content)
    {
        if (content) {
            // handle the content according the function
            switch (Zikula.Mediasharex.Container.func)
            {
                case 'pubtype':
                    this.content.update(content);
                    Zikula.Mediasharex.Pubtype.Init();
                    break;

                case 'modify':
                    this.content.update(content);
                    this.content.innerHTML = this.content.innerHTML.replace('FormDoPostBack', 'Zikula.Mediasharex.Container.instance.formPostBack');
                    Zikula.Mediasharex.Pubfields.Init();
                    break;

                case 'generator':
                    // detection of clip autogenerated code
                    var clipcode = '';
                    content = content.sub(/<script id="clip_generatorcode" type="text\/html">([\s\S\/]+)<pre class="clip-generatorcode">/, function (match) {
                        clipcode = match[0].sub(/<script id="clip_generatorcode" type="text\/html">/, '').sub(/<\/script>([\s\S]+)$/, '');
                        return '<pre class="clip-generatorcode">';
                    })

                    this.content.update(content);

                    // if there's autogenerated code, insert it appart'
                    if (clipcode != '') {
                        var script = document.createElement('script');
                        script.id  = 'clip_generatorcode';
                        script.type = 'text/html';
                        script.update(clipcode);
                        this.content.appendChild(script);
                        $('clip_generatorcode').innerHTML = $('clip_generatorcode').innerHTML.gsub(/href="(.*?)"/, function (match) {
                            match[1] = match[1].replace(Zikula.Config.baseURL, '');
                            return 'href="'+match[1]+'"';
                        });
                        $('clip_generatorcode').innerHTML = $('clip_generatorcode').innerHTML.gsub(/src="(.*?)"/, function (match) {
                            match[1] = match[1].replace(Zikula.Config.baseURL, '');
                            return 'src="'+match[1]+'"';
                        });
                    }
                    break;

                default:
                    this.content.update(content);
            }
            // observe the forms submit buttons
            switch (Zikula.Mediasharex.Container.func)
            {
                case 'modify':
                    var form = this.content.select('form').first();
                    // observe the form buttons
                    form.select('input[type=submit]').each(function(e) {
                        // replace any onclick attribute
                        if (e.onclick) {
                            e.ajaxclick = e.onclick;
                            e.removeAttribute('onclick');
                            e.observe('click', function(event) {
                                if (e.ajaxclick()) {
                                    this.formSend(event)
                                } else {
                                    event.stop();
                                }
                            }.bind(this));
                        } else {
                            e.observe('click', this.formSend.bind(this));
                        }
                    }.bind(this));
                    Zikula.Mediasharex.Container.formid = form.identify();
            }
            // update the loaded tooltips on the ajax content
            Zikula.UI.Tooltips(this.content.getElementsBySelector('.tooltips'));
        }
        this.updateHeights();
        this.hideIndicator();
    },

    formSend: function(event)
    {
        event.stop();

        Zikula.Mediasharex.Ajax.Busy = true;
        this.showIndicator();

        var submit = event.findElement();
        var form   = event.findElement('form');

        form.select('input[type=submit]').each(function(e) {
            if (e != submit) {
                e.disable();
            }
        });

        new Zikula.Ajax.Request(
            form.action,
            {
                method: 'post',
                parameters: form.serialize(),
                onComplete: this.formProcess
            });

        form.select('input[type=submit]').invoke('enable');
    },

    formProcess: function(req)
    {
        Zikula.Mediasharex.Ajax.Busy = false;

        if (!req.isSuccess()) {
            Zikula.showajaxerror(req.getMessage());
            Zikula.Mediasharex.Container.instance.hideIndicator();
            return false;
        }

        if (req.getData()) {
            Zikula.Mediasharex.Container.instance.updateContent(req.getData());

        } else {
            var result = req.decodeResponse();

            if (result.output) {
                // custom function output
                if (result.func) {
                    Zikula.Mediasharex.Container.func = result.func;
                }
                if (result.pars) {
                    Zikula.Mediasharex.Container.pars = result.pars;
                }
                Zikula.Mediasharex.Container.instance.updateContent(result.output);

            } else if (result.redirect) {
                // url redirect
                window.location = result.redirect;

            } else {
                // redirect to a specified function or pubtypeinfo (on cancel)
                Zikula.Mediasharex.Container.func = result.func ? result.func : 'display';
                if (result.pars) {
                    Zikula.Mediasharex.Container.pars = result.pars;
                }
                Zikula.Mediasharex.Ajax.Request(Zikula.Mediasharex.Container.pars, Zikula.Mediasharex.Container.func);
            }

            // TODO update the hash
            // busy enabled should change the hash without problem, but it's not, it's generating a new ajax request
            //Zikula.Mediasharex.Hash.Update(Zikula.Mediasharex.Container.pars, Zikula.Mediasharex.Container.func);
            //Zikula.Mediasharex.Ajax.Busy = false;
        }

        return true;
    },

    formPostBack: function(eventTarget, eventArgument)
    {
        var form = $(Zikula.Mediasharex.Container.formid);

        if (!form.onsubmit || form.onsubmit()) {
            Zikula.Mediasharex.Ajax.Busy = true;
            Zikula.Mediasharex.Container.instance.showIndicator();

            form.FormEventTarget.value = eventTarget;
            form.FormEventArgument.value = eventArgument;

            form.select('input[type=submit]').invoke('disable');

            new Zikula.Ajax.Request(
                form.action,
                //'ajax.php?module=Mediasharex&type=ajax&func='+Zikula.Mediasharex.Container.func+'&tid='+Zikula.Mediasharex.Container.pars.tid+'&lang='+Zikula.Config.lang,
                {
                    method: 'post',
                    parameters: form.serialize(),
                    onComplete: Zikula.Mediasharex.Container.instance.formProcess
                });

            form.select('input[type=submit]').invoke('enable');
        }
    },

    showIndicator: function()
    {
        this.showIndicatorTimeout = window.setTimeout(function(){
            if (this.options.fade){
                this.indicatorEffects.appear = new Effect.Appear(this.indicator, {
                    queue: {
                        position: 'front',
                        scope: 'Zikula.Mediasharex.Container.1'
                    },
                    from: 0,
                    to: 1,
                    duration: this.options.fadeDuration / 2
                });
            } else {
                this.indicator.show();
            }
        }.bind(this), 50);
    },

    hideIndicator: function()
    {
        if (this.showIndicatorTimeout) {
            window.clearTimeout(this.showIndicatorTimeout);
        }
        this.indicator.hide();
    }
});



Object.extend(Zikula.Mediasharex.Container,
{
    instance: null,
    formid: null,
    busy: false,
    func: '',
    pars: {
        url: '',
        id: 0
    },
    register: function(config)
    {
        if (!this.instance) {
            this.instance = new Zikula.Mediasharex.Container(config);
            this.instance.updateHeights();
        }
    }
});


Zikula.Mediasharex.MenuAction = function(node, action)
{
    if (!['modify', 'delete', 'display'].include(action)) {
        return false;
    }

    if (node) {
        node.insert({after: Zikula.Mediasharex.Indicator()});
    }

    var pars = {
            module: 'Mediasharex',
            type: 'ajax',
            func: action,
            id:  node
        };

    switch (action) {
        case 'modify':
            pars.mode = 'modify';
            break;
        case 'display':
            pars.func = 'display';
            break;
        case 'delete':
            pars.type = 'ajaxexec';
    }

    new Zikula.Ajax.Request(
        'ajax.php?', {
            parameters: pars,
            onComplete: Zikula.Mediasharex.MenuActionCallback
        });

    return true;
};

Zikula.Mediasharex.MenuActionCallback = function(req)
{
    Zikula.Mediasharex.Indicator().remove();

    if (!req.isSuccess()) {
        Zikula.showajaxerror(req.getMessage());
        Zikula.Mediasharex.Container.instance.hideIndicator();
        return false;
    }

    var data = req.responseText.evalJSON();

    switch (data.action) {
        case 'display':
            $(document.body).insert(data.result);
            Zikula.Mediasharex.OpenForm(data, Zikula.Mediasharex.EditNode);
            break;
        case 'modify':
            $(document.body).insert(data.result);
            Zikula.Mediasharex.OpenForm(data, Zikula.Mediasharex.AddNode);
            break;
    }

    return true;
};

/* Form Methods 
Zikula.Mediasharex.OpenForm = function(data, callback)
{
    if (Zikula.Mediasharex.Form) {
        Zikula.Mediasharex.Form.destroy();
    }

    Zikula.Mediasharex.Form = jQuery( "#dialog" ).dialog({
       		autoOpen: false,
 			position: { my: "top", at: "center", of: "#floatheader" },
 			open: function (event, ui) { jQuery( "#dialog").css('overflow', 'hidden'); },
 			height: 'auto',
       		close : function(event, ui) { jQuery("#dialog").empty();}   		
       	 });

    return Zikula.Mediasharex.Form.open();
};
*/

/* Form Methods */
Zikula.Mediasharex.OpenForm = function(data, callback)
{
    if (Zikula.Mediasharex.Form) {
        Zikula.Mediasharex.Form.destroy();
    }

    Zikula.Mediasharex.Form = new Zikula.UI.FormDialog($('dialog'), callback, {
        title: $('dialog').title,
        width: 700,
        buttons: [
            {label: Zikula.__('Submit', 'module_clip_js'), type: 'submit', name: 'submit', value: 'submit', 'class': 'z-btgreen', close: false},
            {label: Zikula.__('Cancel', 'module_clip_js'), type: 'submit', name: 'cancel', value: false, 'class': 'z-btred', close: true}
        ]
    });

    return Zikula.Mediasharex.Form.open();
};

Zikula.Mediasharex.CloseForm = function()
{
    Zikula.Mediasharex.Form.destroy();
    Zikula.Mediasharex.Form = null;
};

Zikula.Mediasharex.UpdateForm = function(data)
{
    $('#dialog').replace(data);
    Zikula.Mediasharex.Form.window.indicator.fade({duration: 0.2});
    $('#dialog').show();
};

/* Ajax view functions */
Zikula.Mediasharex.Ajax =
{
    Busy: false,

    Request: function(pars, func, type, callback)
    {
        if (Zikula.Mediasharex.Ajax.Busy || typeof pars != 'object' || typeof pars['id'] == 'undefined') {
            return;
        }

        //Zikula.Mediasharex.Container.instance.showIndicator();

        // update the hash
        func = func ? func : 'display';
        Zikula.Mediasharex.Hash.Update(pars, func);

        // backup the request basis in the class
        Zikula.Mediasharex.Container.func = func;
        Zikula.Mediasharex.Container.pars = Object.clone(pars);

        pars.module = 'Mediasharex';
        //pars.type   = type ? type : 'ajax';
        pars.func   = func;

        // perform the ajax request
        new Zikula.Ajax.Request(
            Zikula.Config.baseURL+'ajax.php?',
            {
                method: 'get',
                parameters: pars,
                onComplete: callback ? callback : Zikula.Mediasharex.Ajax.Callback
            });
    },

    Callback: function(req)
    {
        if ($('ajax_indicator')) {
            $('ajax_indicator').remove();
        }

        if (!req.isSuccess()) {
            Zikula.Mediasharex.Ajax.Busy = false;
            Zikula.showajaxerror(req.getMessage());
            Zikula.Mediasharex.Container.instance.hideIndicator();
            return false;
        }

        Zikula.Mediasharex.Container.instance.updateContent(req.getData());

        Zikula.Mediasharex.Ajax.Busy = false;

        return true;
    }
};
