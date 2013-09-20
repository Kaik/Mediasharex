{adminheader}
<div class="z-admin-content-pagetitle">
     {icon type="import" size="small"}
    <h3>{gt text="Installation"}</h3>
</div>
<div id="mediasharex_install" class="z-clearfix">
    <div id="mediasharex_install_" class="z-clearfix">
      <div id="mediasharex_install_status" class="z-w30 z-formrow z-floatleft"> 
      <h3>{gt text="Instalation status"}</h3>         
       <ul style="list-style: none;">
        <li><p><strong>{gt text="Installed tables"}</strong></p></li>
        {foreach from=$installed_tables key=table item=status}
        <li>{$table} {if $status}{icon type="ok" size="extrasmall"}{else}{icon type="cancel" size="extrasmall"}{/if}</li> 
        {/foreach}
       <li><p><strong>{gt text="Installed handlers"}</strong></p></li> 
       <li>{gt text="Found media handlers"} <i>({$found_handlers})</i></li>    
       <li>{gt text="Found media sources"} <i>({$found_sources})</i></li>
    {if $fileUploadsAllowed}
        <li><p>{icon type="ok" size="extrasmall"}<strong>{gt text="File upload allowed"}</strong></p></li>
    {else}   
       <li><p>{icon type="cancel" size="extrasmall"}<strong>{gt text="No file upload allowed"}</strong></p></li>   
    {/if}                        
       </ul>
     </div> 
         
     <div class="z-w60 z-formrow z-floatright">
        <h3>{gt text="Instalation settings"}</h3>                   
        <div class="mediashare_install_settings z-formrow">

        <form class="z-form" action="{modurl modname="Extensions" type="admin" func="initialise"}" method="post" enctype="application/x-www-form-urlencoded">
        <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />     
        <input type="hidden" name="id" value="{$id|safetext}" />                   
        {foreach from=$install_options key=optionname item=default}
        {if $optionname eq 'activate'}

        {elseif $optionname eq 'general_mediaSizeLimitSingle'}
        <div class="z-formrow "> 
        <label>{gt text="Single upload media size"}</label> <input type="text" class="" value="{$default}" size="40" name="install_options[{$optionname}]" />
        </div>
        {elseif $optionname eq 'rootname'}
        <div class="z-formrow "> 
        <label>{gt text="Top album name"}</label> <input type="text" class="" value="{$default}" size="40" name="install_options[{$optionname}]" />
        </div>         
        {elseif $optionname eq 'general_mediaSizeLimitTotal'}
        <div class="z-formrow "> 
        <label>{gt text="Total space for uploads per user"}</label> <input type="text" class="" value="{$default}" size="40" name="install_options[{$optionname}]" />
        </div> 
        {elseif $optionname eq 'general_tmpDirName'}
        <div class="z-formrow "> 
        <label>{gt text="Temporary upload directory"}</label> <input type="text" class="" value="{$default}" size="40" name="install_options[{$optionname}]" />
        </div> 
        {elseif $optionname eq 'general_mediaDirName'}
        <div class="z-formrow "> 
        <label>{gt text="Media storage directory"}</label> <input type="text" class="" value="{$default}" size="40" name="install_options[{$optionname}]" />
        </div>         
        {elseif $optionname eq 'albums_defaultTheme'}
            <fieldset> 
             <legend>{gt text="Albums default theme"}</legend>
               <label for="mediasharex_albums_defaultTheme">{gt text="Select default theme for new albums"}</label>
            <select id="mediasharex_albums_defaultTheme" name="install_options[albums_defaultTheme]"  >
            {foreach from=$themes_select item=theme}
                <option value="{$theme.value}"   {if $theme.value eq $install_options.albums_defaultTheme}selected="selected"{/if}    >{$theme.text}</option>
            {/foreach}                
            </select>                
           </fieldset>  

        {elseif $optionname eq 'general_startPage'}
            <fieldset > 
             <legend>{gt text="Start page"}</legend>
               <label for="mediasharex_general_startPage_home">{gt text="Home page"}</label>
               <input id="mediasharex_general_startPage" name="install_options[general_startPage]" type="radio" value="home"     {if $install_options.general_startPage eq 'home'}checked="checked"{/if} />                        
               <label for="mediasharex_general_startPage_home">{gt text="Browse view"}</label>
               <input id="mediasharex_general_startPage" name="install_options[general_startPage]" type="radio" value="view"   {if $install_options.general_startPage eq 'view'}checked="checked"{/if} />                           
               <label for="mediasharex_general_startPage_home">{gt text="Explore view"}</label>
               <input id="mediasharex_general_startPage" name="install_options[general_startPage]" type="radio" value="display"  {if $install_options.general_startPage eq 'display'}checked="checked"{/if} />                           
            </fieldset>             
            

        
        {else}
        <div class="z-formrow "> 
        <label>{$optionname}</label> <input type="text" class="" value="{$default}" size="40" name="install_options[{$optionname}]" />
        </div>         
        {/if}
        {/foreach}
        
        <input type="text" class="z-hide" value="2" size="40" name="step" />
        
        <div class="z-formbuttons z-buttons z-formrow">
       <input type="submit" value="{gt text='Save settings'}" name="submit"/>
        </div>
        </form>
             
         </div>   
                     
     </div>
            
     </div>   

</div>
{adminfooter}
