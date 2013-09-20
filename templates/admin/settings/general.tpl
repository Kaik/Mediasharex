{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$settingslinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    <h3><i class="mediasharex-icon-cogs"></i>  {gt text="Mediasharex general settings"}</h3>
</div>


<div id="mediasharex_settings_general" class="z-clearfix">
      <div id="mediasharex_settings_general_form_container" class="z-w60 z-formrow z-floatleft"> 
    <form id="mediasharex_settings_general_form" class="z-form" action="{modurl modname='mediasharex' type='admin' func='settings_general_update'}" method="post" enctype="application/x-www-form-urlencoded">
            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />              
            <fieldset > 
             <legend>{gt text="Directories"}</legend>
                <div class="z-formrow"> 
               <label for="mediasharex_settings_general_tmpDirName">{gt text="Temporary directory"}</label>
               <input id="mediasharex_settings_general_tmpDirName"      name="modulevars[general_tmpDirName]"   type="text" value="{$modulevars.general_tmpDirName}" />                        
               {if $dir_check.general_tmpDirName.writable} <i class="mediasharex-icon-ok-sign"> </i> {gt text="Directory exist and is writable"} {elseif $dir_check.general_tmpDirName.writable == false} <i class="mediasharex-icon-remove-sign"> </i> {gt text="Directory not exist or is not writable"}{/if}               
               <em>{gt text="System temporay dir"}: {$sys_temp_dir}</em>
               </div>
                <div class="z-formrow">                
               <label for="mediasharex_settings_general_mediaDirName">{gt text="Media directory"}</label>
               <input id="mediasharex_settings_general_mediaDirName"    name="modulevars[general_mediaDirName]" type="text" value="{$modulevars.general_mediaDirName}"/>                           
               {if $dir_check.general_mediaDirName.writable} <i class="mediasharex-icon-ok-sign"> </i> {gt text="Directory exist and is writable"} {elseif $dir_check.general_mediaDirName.writable == false} <i class="mediasharex-icon-remove-sign"> </i> {gt text="Directory not exist or is not writable"}{/if}        
                </div>
            </fieldset>  
                           
            <fieldset > 
             <legend>{gt text="Limits"}</legend>
                <div class="z-formrow">              
               <label for="mediasharex_settings_general_mediaSizeLimitSingle">{gt text="Single file upload size"}</label>
               <input id="mediasharex_settings_general_mediaSizeLimitSingle" name="modulevars[general_mediaSizeLimitSingle]" type="text" value="{$modulevars.general_mediaSizeLimitSingle}" />                        
               </div>
                <div class="z-formrow">  
               <label for="mediasharex_settings_general_mediaSizeLimitTotal">{gt text="Media directory max size"}</label>
               <input id="mediasharex_settings_general_mediaSizeLimitTotal" name="modulevars[general_mediaSizeLimitTotal]" type="text" value="{$modulevars.general_mediaSizeLimitTotal}" />                           
                </div>
            </fieldset> 
            
            <fieldset > 
             <legend>{gt text="Start page"}</legend>
               <label for="mediasharex_settings_general_startPage_home">{gt text="Home page"}</label>
               <input id="mediasharex_settings_general_startPage" name="modulevars[general_startPage]" type="radio" value="home"     {if $modulevars.general_startPage eq 'home'}checked="checked"{/if} />                        
               <label for="mediasharex_settings_general_startPage_home">{gt text="Browse view"}</label>
               <input id="mediasharex_settings_general_startPage" name="modulevars[general_startPage]" type="radio" value="view"   {if $modulevars.general_startPage eq 'view'}checked="checked"{/if} />                           
               <label for="mediasharex_settings_general_startPage_home">{gt text="Explore view"}</label>
               <input id="mediasharex_settings_general_startPage" name="modulevars[general_startPage]" type="radio" value="display"  {if $modulevars.general_startPage eq 'display'}checked="checked"{/if} />                           
            </fieldset>             
            
                        
           
              <div class="z-formbuttons z-buttons">
            <button type="submit"><i class="mediasharex-icon-redo"> </i> {gt text='Update'}</button>
            </div>
        </form>
      </div>
      <div id="mediasharex_admin_documentation" class="z-formrow z-w35 z-floatright">
      {$file_content}
      </div>
</div>      
{adminfooter}
{*zdebug*}