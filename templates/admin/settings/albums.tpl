{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$settingslinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    <h3><i class="mediasharex-icon-folder"></i>  {gt text="Albums settings"}</h3>
</div>


<div id="mediasharex_mainsettings" class="z-clearfix">
      <div id="mediasharex_mainsettings_form" class="z-w40 z-formrow z-floatleft"> 
    <form id="mediasharex_mainsettings_form" class="z-form" action="{modurl modname="mediasharex" type="admin" func="updatemainsettings"}" method="post" enctype="application/x-www-form-urlencoded">

            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           

            <fieldset> 
             <legend>{gt text="Album categories"}</legend>
               <label for="mediasharex_enablealbumattributies">{gt text="Check this box to enable categories for albums"}</label>
               <input id="mediasharex_enablealbumattributies" name="modulevars[enablealbumattributies]" type="checkbox" value="1" {if $modvars.Mediasharex.enableattribution}checked="checked"{/if} />                        
           </fieldset> 
                     
            <fieldset> 
             <legend>{gt text="Album meta data"}</legend>
               <label for="mediasharex_enablealbumattributies">{gt text="Check this box to enable attributies"}</label>
               <input id="mediasharex_enablealbumattributies" name="modulevars[enablealbumattributies]" type="checkbox" value="1" {if $modvars.Mediasharex.enableattribution}checked="checked"{/if} />                        
           </fieldset>             
            
            <fieldset> 
             <legend>{gt text="Album default theme"}</legend>
               <label for="mediasharex_enablealbumattributies">{gt text="Check this box to enable attributies"}</label>
               <input id="mediasharex_enablealbumattributies" name="modulevars[enablealbumattributies]" type="text" value="{$modvars.Mediasharex.enableattribution}" />                        
           </fieldset> 
           
            <fieldset> 
             <legend>{gt text="User album"}</legend>
               <label for="mediasharex_enablealbumattributies">{gt text="Check this box to enable private albums for users"}</label>
               <input id="mediasharex_enablealbumattributies" name="modulevars[enablealbumattributies]" type="checkbox" value="1" {if $modvars.Mediasharex.enableattribution}checked="checked"{/if} />                        
           </fieldset>            
           
                                    
           
              <div class="z-formbuttons z-buttons">
            <button type="submit"><i class="mediasharex-icon-redo"></i> {gt text='Update'}</button>
            </div>
        </form>
      </div>
     <div id="mediasharex_mainsettings_info" class="z-w60 z-formrow z-floatright z-center"> 
           {thumb image="modules/Mediasharex/images/settings/albums.jpg" tag=true width=480 height=380 mode='inset' extension='png'}                          
      </div>
</div>      
{adminfooter}
