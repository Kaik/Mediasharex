{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="display" size="small"}
    <h3>{gt text="Manage handlers"}</h3>
</div>
{if $files|@count neq $mediaHandlers|@count}
<div class="z-warningmsg">
{gt text="Found changes in handlers storage"}
<a href="{modurl modname='Mediasharex' type='admin' func='reloadhandlers'}"> {icon type="regenerate" size="extrasmall"} {gt text="Reload handlers"}</a> 
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


<div id="mediasharex_managehandlers_mimetypes">
    <h3>{gt text="Supported MimeTypes"}</h3>
<table id="mediasharex_managehandlers_table" class="z-datatable">
    <thead>
    <tr>
    <th>
    <span class="z-nowrap">{gt text="MimeType"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="File type"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Handler name"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Handler"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Internal MimeType"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Internal File type"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Active"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="options"}</span>
    </th>
   </tr>
    </thead>
    <tbody>
    {foreach from=$mediaHandlers item=item}
        <tr >
            <td>
             {$item.mimetype}  
            </td>
            <td>
             {$item.filetype}  
            </td>
            <td>
             {$item.title}   
            </td>
            <td>
             {$item.handler}   
            </td>
            <td>
             {$item.foundmimetype}   
            </td>
            <td>
             {$item.foundfiletype}   
            </td>
            <td>
             {$item.active}   
            </td>
            <td>
            <a href="{modurl modname='Mediasharex' type='user' func='modify_handler' id=$item.id}">{gt text="Edit"}</a> 
            </td>
        </tr>
    {/foreach}
    </tbody>
    </table>    
     {pager rowcount=$pager.numitems class="z-pager tip" limit=$pager.itemsperpage posvar='page' shift=1 }   
 
</div>
{adminfooter}
{*zdebug*}
