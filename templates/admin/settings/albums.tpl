{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$settingslinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    <h3><i class="mediasharex-icon-folder"></i>  {gt text="Albums settings"}</h3>
</div>


<div id="mediasharex_admin_settings" class="z-clearfix">
      <div id="mediasharex_admin_settings_form" class="z-w60 z-formrow z-floatleft"> 
    <form id="mediasharex_admin_settings_form" class="z-form" action="{modurl modname="mediasharex" type="admin" func="settings_albums_update"}" method="post" enctype="application/x-www-form-urlencoded">

            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           

            <fieldset> 
             <legend>{gt text="Albums categories"}</legend>
               <label for="mediasharex_albums_enableCategories">{gt text="Check this box to enable categories for albums"}</label>
               <input type="hidden" name="modulevars[albums_enableCategories]" value="0" />
               <input id="mediasharex_albums_enableCategories" name="modulevars[albums_enableCategories]" type="checkbox" value="1" {if $modulevars.albums_enableCategories}checked="checked"{/if} />                        
           </fieldset> 
                     
            <fieldset> 
             <legend>{gt text="Albums meta data"}</legend>
               <label for="mediasharex_albums_enableAttributies">{gt text="Check this box to enable attributies"}</label>
               <input type="hidden" name="modulevars[albums_enableAttributies]" value="0" />
               <input id="mediasharex_albums_enableAttributies" name="modulevars[albums_enableAttributies]" type="checkbox" value="1" {if $modulevars.albums_enableAttributies}checked="checked"{/if} />                        
           </fieldset>             
            
            <fieldset> 
             <legend>{gt text="Albums default theme"}</legend>
               <label for="mediasharex_albums_defaultTheme">{gt text="Select default theme for new albums"}</label>
            <select id="mediasharex_albums_defaultTheme" name="modulevars[albums_defaultTheme]"  >
            {foreach from=$themes_select item=theme}
                <option value="{$theme.value}"   {if $theme.value eq $modulevars.albums_defaultTheme}selected="selected"{/if}    >{$theme.text}</option>
            {/foreach}                
            </select>                
           </fieldset>  
           
            <fieldset> 
             <legend>{gt text="User album"}</legend>
               <label for="mediasharex_albums_userAlbum_Enabled">{gt text="Check this box to enable private albums for users"}</label>
               <input type="hidden" name="modulevars[albums_userAlbum_Enabled]" value="0" />
               <input id="mediasharex_albums_userAlbum_Enabled" name="modulevars[albums_userAlbum_Enabled]" type="checkbox" value="1" {if $modulevars.albums_userAlbum_Enabled}checked="checked"{/if} />                        
            {if $modulevars.albums_userAlbum_Enabled}
            <label for="mediasharex_albums_userAlbum_HomeAlbum">{gt text="Home (parent) album ID for user albums"}</label>
            <input id="mediasharex_albums_userAlbum_HomeAlbum" name="modulevars[albums_userAlbum_HomeAlbum]" type="text" size="5" value="{$modulevars.albums_userAlbum_HomeAlbum}" />                        
            <br />
            <label for="mediasharex_albums_userAlbum_HomeAlbumTheme">{gt text="Home (parent) album theme"}</label>
            <select id="mediasharex_albums_userAlbum_HomeAlbumTheme" name="modulevars[albums_userAlbum_HomeAlbumTheme]"  >
            {foreach from=$themes_select item=theme}
                <option value="{$theme.value}"   {if $theme.value eq $modulevars.albums_userAlbum_HomeAlbumTheme}selected="selected"{/if}    >{$theme.text}</option>
            {/foreach}                
            </select>                
            <br />      
            <label for="mediasharex_albums_userAlbum_AlbumsTheme">{gt text="User album theme"}</label>
            <select id="mediasharex_albums_userAlbum_AlbumsTheme" name="modulevars[albums_userAlbum_AlbumsTheme]"  >
            {foreach from=$themes_select item=theme}
                <option value="{$theme.value}"   {if $theme.value eq $modulevars.albums_userAlbum_AlbumsTheme}selected="selected"{/if}    >{$theme.text}</option>
            {/foreach}                
            </select>                  

            {/if}
            
           </fieldset>                 
            <div class="z-formbuttons z-buttons">
            <button type="submit"><i class="mediasharex-icon-redo"></i> {gt text='Update'}</button>
            </div>
        </form>
      </div>
      <div id="mediasharex_admin_documentation" class="z-formrow z-w35 z-floatright">
      {$file_content}
      </div>
</div>      
{adminfooter}
{*zdebug*}