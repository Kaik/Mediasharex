{adminheader}
{modulelinks links=$settingslinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    {icon type="config" size="small"}
    <h3>{gt text="Mediasharex general settings"}</h3>
</div>


<div id="mediasharex_mainsettings" class="z-clearfix">
      <div id="mediasharex_mainsettings_form" class="z-w40 z-formrow z-floatleft"> 
    <form id="mediasharex_mainsettings_form" class="z-form" action="{modurl modname="mediasharex" type="admin" func="updatemainsettings"}" method="post" enctype="application/x-www-form-urlencoded">

            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           
            
            <fieldset> 
             <legend>{gt text="Folders"}</legend>
               <label for="mediasharex_enableattribution">{gt text="Temp dir"}</label>
               <input id="mediasharex_enableattribution" name="modulevars[enableattribution]" type="text" value="{$modvars.Mediasharex.enableattribution}" />                        
               <br />
               <label for="mediasharex_enableimporttables">{gt text="Media directory"}</label>
               <input id="mediasharex_enableimporttables" name="modulevars[enableimporttables]" type="text" value="{$modvars.Mediasharex.enableattribution}"/>                           
            </fieldset>  

            <fieldset> 
             <legend>{gt text="Folders"}</legend>
               <label for="mediasharex_enableattribution">{gt text="Temp dir"}</label>
               <input id="mediasharex_enableattribution" name="modulevars[enableattribution]" type="text" value="{$modvars.Mediasharex.enableattribution}" />                        
               <br />
               <label for="mediasharex_enableimporttables">{gt text="Media directory"}</label>
               <input id="mediasharex_enableimporttables" name="modulevars[enableimporttables]" type="text" value="{$modvars.Mediasharex.enableattribution}"/>                           
            </fieldset>  

                   
            <fieldset> 
             <legend>{gt text="Limits"}</legend>
               <label for="mediasharex_enableattribution">{gt text="display 1"}</label>
               <input id="mediasharex_enableattribution" name="modulevars[enableattribution]" type="checkbox" value="1" {if $modvars.Mediasharex.enableattribution}checked="checked"{/if} />                        
               <label for="mediasharex_enableimporttables">{gt text="display 2"}</label>
               <input id="mediasharex_enableimporttables" name="modulevars[enableimporttables]" type="checkbox" value="1" {if $modvars.Mediasharex.enableimporttables}checked="checked"{/if} />                           
            </fieldset> 
            
            <fieldset> 
             <legend>{gt text="Modes"}</legend>
               <label for="mediasharex_enableattribution">{gt text="Temp dir"}</label>
               <input id="mediasharex_enableattribution" name="modulevars[enableattribution]" type="checkbox" value="1" {if $modvars.Mediasharex.enableattribution}checked="checked"{/if} />                        
               <label for="mediasharex_enableimporttables">{gt text="Media directory"}</label>
               <input id="mediasharex_enableimporttables" name="modulevars[enableimporttables]" type="checkbox" value="1" {if $modvars.Mediasharex.enableimporttables}checked="checked"{/if} />                           
            </fieldset>             
            
                        
           
            <div class="z-formbuttons z-buttons">
                {button src='button_ok.png' set='icons/extrasmall' __alt='Save' __title='Save' __text='Save'}
                <a href="{modurl modname='fconnect' type='admin' func='main'}" title="{gt text='Cancel'}">{img modname='core' src='button_cancel.png' set='icons/extrasmall' __alt='Cancel' __title='Cancel'} {gt text='Cancel'}</a>
            </div>
    </form>


      </div>

     <div id="mediasharex_mainsettings_info" class="z-w60 z-formrow z-floatright"> 

           {thumb image="modules/Mediasharex/images/install_banner.jpg" tag=true width=580 height=380 mode='inset' extension='png'}                          

      </div>
      
</div>      
      
      
      
      
      
      
      
      
      
      
      
      
      

<div class="">
    </div>

{adminfooter}
