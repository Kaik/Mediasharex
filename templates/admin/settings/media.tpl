{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$settingslinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-images"></i> {gt text="Media settings"}</h3>
</div>


<div id="mediasharex_mainsettings" class="z-clearfix">
      <div id="mediasharex_mainsettings_form" class="z-w60 z-formrow z-floatleft"> 
    <form id="mediasharex_mainsettings_form" class="z-form" action="{modurl modname="mediasharex" type="admin" func="settings_media_update"}" method="post" enctype="application/x-www-form-urlencoded">

            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           
            
            <fieldset> 
             <legend>{gt text="Media categories"}</legend>
               <label for="mediasharex_media_enableCategories">{gt text="Check this box to enable categories for media items"}</label>
                <input type="hidden" name="modulevars[media_enableCategories]" value="0" />
               <input id="mediasharex_media_enableCategories" name="modulevars[media_enableCategories]" type="checkbox" value="1" {if $modulevars.media_enableCategories}checked="checked"{/if} />                        
           </fieldset> 
                     
            <fieldset> 
             <legend>{gt text="Media meta data"}</legend>
               <label for="mediasharex_media_enableAttributies">{gt text="Check this box to enable attributies"}</label>
               <input type="hidden" name="modulevars[media_enableAttributies]" value="0" />
               <input id="mediasharex_media_enableAttributies" name="modulevars[media_enableAttributies]" type="checkbox" value="1" {if $modulevars.media_enableAttributies}checked="checked"{/if} />                        
           </fieldset>            
           
              <div class="z-formbuttons z-buttons">
            <button type="submit"><i class="mediasharex-icon-redo"></i> {gt text='Update'}</button>
            </div>
        </form>
      </div>
      <div class="mediasharex_admin_settings_status_doc z-formrow z-w35 z-floatright">
      {$file_content}
      </div>
</div>      
