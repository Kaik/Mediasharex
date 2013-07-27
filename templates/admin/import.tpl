{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="filter" size="small"}
    <h3>{gt text="Import"}</h3>
</div>
{if $foundmediashare}
<div class="z-informationmsg z-clearer">
<h3>{gt text="Found Mediashare installed"}</h3>
    <ul>
    <li>{gt text="Version:"} {$foundmediashare.version}</li>    
    <li>{gt text="state:"} {$foundmediashare.state}</li>
    <li>{gt text="Proceed with automatic import"}</li>
    </ul>
</div>    

{else}
<div class="z-informationmsg z-clearer">
<h3>{gt text="Mediashare is not present"}</h3>
</div> 

{/if}

{if $enableimporttables}
{if $compat_tables|@count > 0}
<form id="mediasharex_import" class="z-form" action="{modurl modname="mediasharex" type="admin" func="manageimport"}" method="post" enctype="application/x-www-form-urlencoded">
 
<div class="z-clearer">
<h3>{gt text="Found Mediasharex compatibilite tables"}</h3>
    <div class="z-clearfix">
    <div class="z-clearer">    
        {gt text="MX Table"}
    </div>
    <div class="z-w40 z-floatleft">
        {gt text="MX fields"}
    </div>
    <div class="z-w35 z-floatleft" style="margin-left:15px;">    
        {gt text="Fields"}
    </div>
    <div class="z-w10 z-floatright">
        {gt text="Options"}
    </div>      
    </div> 
    {foreach from=$compat_tables key=tnamex item=tableinfo}
    <div class="z-formrow z-clearfix">
    <div class="z-clearer">    
        <strong>{$tnamex}</strong>
    </div>
    <div class="z-w45 z-floatleft">
        {foreach from=$tableinfo.fields key=fieldx item=field}
        <div class="z-clearfix z-clearer">
        {$field}
        {foreach from=$tableinfo.foundtables key=tiname item=tablec}
        <input type="text" class="z-floatright" value="{$tiname}:{$tablec.$field.name}" size="40" name="import[{$tnamex}][{$tiname}][{$fieldx}]" />
        {/foreach}
        </div>
        {/foreach}
    </div>
    <div class="z-w35 z-floatleft" style="margin-left:15px;">    
        {foreach from=$tableinfo.foundtables key=tname item=table} 
        {foreach from=$table key=fkey item=field}
        <div class="z-clearfix z-clearer" style="margin:7px;">{$tname}:{$field.name}</div>
        {/foreach}   
        {/foreach}
    </div>
    <div class="z-w10 z-floatright">
    <div class="z-formbuttons z-buttons">
    <button name="mode" value="{$tnamex}"> {gt text='Import'}</button>
    </div>

    </div>       
    </div>    
  {/foreach}
  </div>
    <div class="z-formbuttons z-buttons">  
  <a href="{modurl modname='fconnect' type='admin' func='main'}" title="{gt text='Cancel'}">{img modname='core' src='button_cancel.png' set='icons/extrasmall' __alt='Cancel' __title='Cancel'} {gt text='Cancel'}</a>
    </div>
</form>      
{/if}
{else}
<div class="z-warningmsg z-clearer">
<form id="mediasharex_import" class="z-form" action="{modurl modname="mediasharex" type="admin" func="importenabletables"}" method="post" enctype="application/x-www-form-urlencoded">

<h3>{gt text="Import tables are not enabled"}</h3>
     <legend>{gt text="Enable additional import tables"}</legend>
     <label for="mediasharex_enableimporttables">{gt text="Enable"}</label>
     <input id="mediasharex_enableimporttables" name="enableimporttables" type="checkbox" value="1" {if $enableimporttables}checked="checked"{/if} />                        
            

    <div class="z-formbuttons z-buttons">  
    <button name="save" value="{$tnamex}"> {gt text='Save'}</button>
    </div>
    
</form>
</div>    
{/if}



{adminfooter}
{*zdebug*}
