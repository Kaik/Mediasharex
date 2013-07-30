{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$managerlinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-folder"></i> {gt text="Manage invitations"}</h3>
</div>
<div id="mediasharex_manageitems">
<table id="mediasharex_manageitems_table" class="z-datatable">
    <thead>
    <tr>
    <th>
    <span class="z-nowrap">{gt text="Id"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Parent"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Title"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Author"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="MediaHandler"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Original"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Position"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Options"}</span>
    </th>
   </tr>
    </thead>
    <tbody>
    {foreach from=$items item=item}
        <tr >
            <td>
             {$item.id}   
            </td>
            <td>
             {$item.parentalbum}   
            </td>
            <td>
             {$item.title}   
            </td>
            <td>
             {$item.author}  
            </td>
            <td>
             {$item.handler}  
            </td>
            <td>
             {$item.original}   
            </td>
            <td>
             {$item.position}   
            </td>
            <td>
            <a href="{modurl modname='Mediasharex' type='admin' func='modify_mediaitem' id=$item.id}">{gt text="Edit"}</a>    
            </td>
        </tr>
    {/foreach}
    </tbody>
    </table>    
     {pager rowcount=$pager.numitems class="z-pager tip" limit=$pager.itemsperpage posvar='page' shift=1 }   
    
</div>
{adminfooter}
{*zdebug*}
