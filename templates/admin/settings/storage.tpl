{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$settingslinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-cogs"> </i> {gt text="Storage settings"}</h3>
</div>


<div id="mediasharex_mainsettings" class="z-clearfix">
      <div id="mediasharex_mainsettings_form_container" class="z-w60 z-formrow z-floatleft"> 
    <form id="mediasharex_mainsettings_form" class="z-form" action="{modurl modname='mediasharex' type='admin' func='settings_storage_update'}" method="post" enctype="application/x-www-form-urlencoded">

            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           
            
            <fieldset> 
             <legend>{gt text="Storage type"}</legend>
               <label for="mediasharex_storage_type">{gt text="Select default storage for media"}</label>
            <select id="mediasharex_storage_type" name="modulevars[storage_type]"  >
            {foreach from=$storages_select item=storage}
                <option value="{$storage.value}"   {if $storage.value eq $modulevars.storage_type}selected="selected" {/if}>{$storage.text}</option>
            {/foreach}                
            </select>                
           </fieldset>  
     
              <div class="z-formbuttons z-buttons">
            <button type="submit"><i class="mediasharex-icon-redo"> </i> {gt text='Update'}</button>
            </div>
        </form>
      </div>
      <div class="mediasharex_admin_settings_status_doc z-formrow z-w35 z-floatright">
      {$file_content}
      </div>
</div>      
{adminfooter}
{*zdebug*}
