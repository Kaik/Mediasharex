{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$settingslinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    <h3><i class="mediasharex-icon-cogs"></i>  {gt text="Mediasharex general settings"}</h3>
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
            <button type="submit"><i class="mediasharex-icon-redo"></i> {gt text='Update'}</button>
            </div>
        </form>
      </div>
     <div id="mediasharex_mainsettings_info" class="z-w60 z-formrow z-floatright z-center"> 
           {thumb image="modules/Mediasharex/images/settings/general.jpg" tag=true width=480 height=380 mode='inset' extension='png'}                          
      </div>
</div>      
{adminfooter}
