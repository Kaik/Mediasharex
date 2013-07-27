{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="display" size="small"}
    <h3>{gt text="Manage Media Store"}</h3>
</div>
<div id="mediasharex_managemediastore">
<table id="mediasharex_managemediastore_table" class="z-datatable">
    <thead>
    <tr>
    <th>
    <span class="z-nowrap">{gt text="Id"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Media item"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Preview"}</span>
    </th>    
    <th>
    <span class="z-nowrap">{gt text="File ref"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="mimeType"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="width"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="height"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="bytes"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="options"}</span>
    </th>
   </tr>
    </thead>
    <tbody>
    {foreach from=$mediastore item=item}
        <tr >
            <td>
             {$item.id}   
            </td>
            <td>
             {$item.mediaitem}   
            </td>
            <td>
             {$item.previewname}   
            </td>
            <td>
             {$item.fileref}   
            </td>
            <td>
             {$item.mimetype}   
            </td>
            <td>
             {$item.width}  
            </td>
            <td>
             {$item.height}  
            </td>
            <td>
             {$item.bytes}  
            </td>
            <td>
            <a href="{modurl modname='Mediasharex' type='admin' func='modify_storeitem' id=$item.id}">{gt text="Edit"}</a>   
            </td>
        </tr>
    {/foreach}
    </tbody>
    </table>
     {pager rowcount=$pager.numitems class="z-pager tip" limit=$pager.itemsperpage posvar='page' shift=1 }   
    
</div>
{adminfooter}
