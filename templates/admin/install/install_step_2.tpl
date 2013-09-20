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
        
        <div class="z-formrow "> 
        {if $dir_check.general_tmpDirName.writable} {icon type="ok" size="extrasmall"} {gt text="Temporary folder exist and is writable"}{else} {icon type="cancel" size="extrasmall"} {gt text="Temporary folder not exist or is not writable"}{/if}
        </div>         
        <div class="z-formrow "> 
        {if $dir_check.general_tmpDirName.writable} {icon type="ok" size="extrasmall"} {gt text="Storage folder exist and is writable"} {else} {icon type="cancel" size="extrasmall"} {gt text="Temporary folder not exist or is not writable"}{/if}
        </div>         

        <div class="z-formrow "> 
        {icon type="ok" size="extrasmall"} {gt text="Default settings saved"} 
        </div> 

        <div class="z-formrow "> 
        {if $root} {icon type="ok" size="extrasmall"} {gt text="Top album created"} {else} {icon type="cancel" size="extrasmall"} {gt text="Top album not created!"}{/if}
        </div> 

        <div class="z-formrow "> 
        {if $system_album} {icon type="ok" size="extrasmall"} {gt text="System album created"} {else} {icon type="cancel" size="extrasmall"} {gt text="System album not created!"}{/if}
        </div>
        
        <div class="z-formrow "> 
        {if $user_album} {icon type="ok" size="extrasmall"} {gt text="Users album created"} {else} {icon type="cancel" size="extrasmall"} {gt text="Users album not created"}{/if}
        </div>
        
        <div class="z-formrow "> 
        {if $mediasources_checked} {icon type="ok" size="extrasmall"} {gt text="Media sources loaded"} {else} {icon type="cancel" size="extrasmall"} {gt text="Media sources not loaded!"}{/if}
        </div> 
        
        <div class="z-formrow "> 
        {if $mediahandlers_checked} {icon type="ok" size="extrasmall"} {gt text="Media handlers loaded"} {else} {icon type="cancel" size="extrasmall"} {gt text="Media handlers not loaded!"}{/if}
        </div>                   
        <div class="z-formrow "> 
        <h3>{gt text="Installation finished"}</h3>
        </div>         
        <input type="text" class="z-hide" value="3" size="40" name="step" />
        
        <div class="z-formbuttons z-buttons z-formrow">
       <input type="submit" value="{gt text='Activate module'}" name="submit"/>
        </div>
        </form>
             
         </div>  
</div>
{adminfooter}
{zdebug}
