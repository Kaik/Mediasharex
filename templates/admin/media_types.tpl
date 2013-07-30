{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$sandhlinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}
<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-tags"></i> {gt text="Media types"}</h3>
</div>
<div id="mediasharex_managehandlers_mimetypes">
    <h3>{gt text="Supported media types"}</h3>
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
