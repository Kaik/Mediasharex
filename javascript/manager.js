Zikula.define('Mediasharex');

document.observe("dom:loaded", function()
{
    Zikula.Mediasharex.Container.register();
    //hash behaviors
    Event.observe(window, 'hashchange', Zikula.Mediasharex.Hash.Listener);

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

		//alert(func);

        Zikula.Mediasharex.Ajax.Request(pars, func);
       Zikula.Mediasharex.Hash.Update();

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

		if (pars){
        newhash = pars.id+'/'+func+newhash;
		}else {
		newhash = '';			
		}

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

    updateContent: function(content)
    {
        if (content) {
            // handle the content according the function
            switch (Zikula.Mediasharex.Container.func)
            {
                case 'display':
                    this.content.update(content);
                    Zikula.Mediasharex.OpenForm();
                    break;
                case 'modify':
                    this.content.update(content);
                    Zikula.Mediasharex.OpenForm();
                    Zikula.Mediasharex.Edit.Init(); 
                    Zikula.Mediasharex.Images.Listener();
					jQuery("#mediasharex_edit_img_delete").on("click",Zikula.Mediasharex.Images.Delete);
					//var ed = new Xinha('content');
  					//ed.generate();
                    break;                
                case 'online':                	 
 					 jQuery('#item_'+ content.id +'_state a').attr('href','#'+ content.id +'/online');
                     jQuery('#item_'+ content.id +'_state a i').removeClass('offline').addClass('online');                 
                   break;
                case 'offline':
                     jQuery('#item_'+ content.id +'_state a').attr('href','#'+ content.id +'/online');
                     jQuery('#item_'+ content.id +'_state a i').removeClass('online').addClass('offline'); 
                     break;
                case 'image':
                    this.content.update(content);
                    Zikula.Mediasharex.OpenForm();
                    break;
                case 'category':
                    this.content.update(content);
                    Zikula.Mediasharex.OpenForm();
                    break;                 
                case 'topic':
                    this.content.update(content);
                    Zikula.Mediasharex.OpenForm();
                    break;                     
                    
                default:
                    this.content.update(content);
                    Zikula.Mediasharex.OpenForm();
            }
            // observe the forms submit buttons
            switch (Zikula.Mediasharex.Container.func)
            {
            	case 'image':
            	case 'category':
            	case 'topic':
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
                    Zikula.Mediasharex.OpenForm();
            }
            // update the loaded tooltips on the ajax content
        }
        
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
			
			if (result.cancel) {
			
			Zikula.Mediasharex.CloseForm();
			
			}else if (result.output) {
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
        }
    }
});

/* Form Methods */
Zikula.Mediasharex.OpenForm = function(data, callback)
{
    if (Zikula.Mediasharex.Form) {
        Zikula.Mediasharex.Form.destroy();
    }

    jQuery( "#dialog" ).dialog({
       		autoOpen: false,
 			position: { my: "top", at: "center", of: "#floatheader" },
 			open: function (event, ui) { jQuery( "#dialog").css('overflow', 'hidden'); },
 			height: 'auto',
       		  close : function(event, ui) {
      					jQuery("#dialog").empty();
   						}   		
       	 });
    jQuery( "#dialog" ).dialog( "option", "width", 980 );

    jQuery( "#dialog" ).dialog( "open" );
};

Zikula.Mediasharex.CloseForm = function()
{
    
    Zikula.Mediasharex.Form.close();
    Zikula.Mediasharex.Form.destroy();
    Zikula.Mediasharex.Form = null;
};

Zikula.Mediasharex.UpdateForm = function(data)
{
    $('#dialog').replace(data);
    Zikula.Mediasharex.Form.window.indicator.fade({duration: 0.2});
    $( "#dialog" ).dialog({ show: "slow" });
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

		//alert(func);	

        Zikula.Mediasharex.Container.instance.showIndicator();

        // update the hash
        func = func ? func : 'display';
        Zikula.Mediasharex.Hash.Update(pars, func);

        // backup the request basis in the class
        Zikula.Mediasharex.Container.func = func;
        Zikula.Mediasharex.Container.pars = Object.clone(pars);

        pars.module = 'Mediasharex';
        pars.type   = type ? type : 'ajax';
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
        if ($('mediasharex_indicator')) {
            $('mediasharex_indicator').remove();
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
