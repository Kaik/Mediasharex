{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="config" size="small"}
    <h3>{gt text="Settings"}</h3>
</div>
<div class="">
    <form id="mediasharex_config" class="z-form" action="{modurl modname="mediasharex" type="admin" func="updatemainsettings"}" method="post" enctype="application/x-www-form-urlencoded">
        <div>
            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           
            <fieldset> 
             <legend>{gt text="Enable Attribution"}</legend>
               <label for="mediasharex_enableattribution">{gt text="Enable"}</label>
               <input id="mediasharex_enableattribution" name="modulevars[enableattribution]" type="checkbox" value="1" {if $modvars.Mediasharex.enableattribution}checked="checked"{/if} />                        
             <legend>{gt text="Enable additional import tables"}</legend>
               <label for="mediasharex_enableimporttables">{gt text="Enable"}</label>
               <input id="mediasharex_enableimporttables" name="modulevars[enableimporttables]" type="checkbox" value="1" {if $modvars.Mediasharex.enableimporttables}checked="checked"{/if} />                           
            </fieldset> 
        
        <fieldset> 
        <legend>{gt text="Settings"}</legend>                       
        {foreach from=$modulevars key=optionname item=default}
        {if $optionname eq 'enableattribution'}
        {elseif $optionname eq 'enableimporttables'}
        {else}
        <div class="z-formrow "> 
        <label>{$optionname}</label> <input type="text" class="" value="{$default}" size="40" name="modulevars[{$optionname}]" />
        {if isset($dir_check.$optionname.writable) &&  $dir_check.$optionname.writable} {icon type="ok" size="extrasmall"} {gt text="Directory exist and is writable"} {elseif isset($dir_check.$optionname.writable) &&  $dir_check.$optionname.writable == false} {icon type="cancel" size="extrasmall"} {gt text="Directory not exist or is not writable"}{/if}
        </div>         
        {/if}
        {/foreach}            
        </fieldset>    
              
            
            <div class="z-formbuttons z-buttons">
                {button src='button_ok.png' set='icons/extrasmall' __alt='Save' __title='Save' __text='Save'}
                <a href="{modurl modname='fconnect' type='admin' func='main'}" title="{gt text='Cancel'}">{img modname='core' src='button_cancel.png' set='icons/extrasmall' __alt='Cancel' __title='Cancel'} {gt text='Cancel'}</a>
            </div>
        </div>
    </form>
    </div>

{adminfooter}
