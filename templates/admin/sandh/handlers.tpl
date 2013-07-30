{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$sandhlinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}
<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-folder"></i> {gt text="Media handlers"}</h3>
</div>
{if $files|@count neq $mediaHandlers|@count}
<div class="z-informationmsg">
{gt text="Click here to reload handlers from directory"}
<a href="{modurl modname='Mediasharex' type='admin' func='manager_reload_handlers'}"> {icon type="regenerate" size="extrasmall"} {gt text="Reload handlers"}</a> 
</div>
{else}
<div class="z-statusmsg">
{gt text="Handlers DB is actual"} 
</div>
{/if}
<div class="">
    <h3>{gt text="Handlers"}</h3>
<table id="mediasharex_managehandlers_table" class="z-datatable">
    <thead>
    <tr>    
    <th>
    <span class="z-nowrap">{gt text="Handler name"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Handler"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="options"}</span>
    </th>
   </tr>
    </thead>
    <tbody>
    {foreach from=$files item=item}
        <tr >
            <td>
             {$item.title}   
            </td>
            <td>
             {$item.handler}   
            </td>
            <td>
            <a href="{modurl modname='Mediasharex' type='admin' func='modify_handler' id=$item.id}">{gt text="Edit"}</a> 
            </td>
        </tr>
    {/foreach}
    </tbody>
    </table>     
    
    
</div>

{adminfooter}
{*zdebug*}
