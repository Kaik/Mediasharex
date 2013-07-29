{adminheader}
<div class="z-admin-content-pagetitle">
     {icon type="import" size="small"}
    <h3>{gt text="Installation"}</h3>
</div>
<div id="mediasharex_install" class="z-clearfix">
        <div class="mediashare_install_settings z-formrow">
        <h3>{gt text="Saved settings"}</h3>
        <form class="z-form" action="{modurl modname="Extensions" type="admin" func="initialise"}" method="post" enctype="application/x-www-form-urlencoded">
        <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />     
        <input type="hidden" name="id" value="{$id|safetext}" />                     
        {foreach from=$install_options key=optionname item=default}
        {if $optionname eq 'activate'}       
        {elseif $optionname eq 'mediaDirName'}
        <div class="z-formrow "> 
        {if $dir_check.$optionname.writable} {icon type="ok" size="extrasmall"} {else} {icon type="cancel" size="extrasmall"} {/if}{gt text="Name"} = <strong>{$optionname}</strong>  {gt text="Value"} = <strong>{$default}</strong>
        </div>         
        {elseif $optionname eq 'tmpDirName'}
        <div class="z-formrow "> 
        {if $dir_check.$optionname.writable} {icon type="ok" size="extrasmall"} {else} {icon type="cancel" size="extrasmall"} {/if}{gt text="Name"} = <strong>{$optionname}</strong>  {gt text="Value"} = <strong>{$default}</strong>
        </div>         
        {else}
        <div class="z-formrow "> 
        {icon type="ok" size="extrasmall"} {gt text="Name"} = <strong>{$optionname}</strong>  {gt text="Value"} = <strong>{$default}</strong>
        </div>         
        {/if}
        {/foreach}
        
        <input type="text" class="z-hide" value="3" size="40" name="step" />
        
        <div class="z-formbuttons z-buttons z-formrow">
       <input type="submit" value="{gt text='Activate module'}" name="submit"/>
        </div>
        </form>
             
         </div>  
</div>
{adminfooter}
