{adminheader}
{modulelinks links=$managerlinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    {icon type="display" size="small"}
    <h3>{gt text="Manage albums"}</h3>
</div>

<div id="mediasharex_managealbums">
<table id="mediasharex_managealbums_table" class="z-datatable">
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
    <span class="z-nowrap">{gt text="Template"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Access"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="MainMedia"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Thumbnail size"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Options"}</span>
    </th>
   </tr>
    </thead>
    <tbody>
    {foreach from=$albums item=album}
        <tr >
            <td>
             {$album.id}   
            </td>
            <td>
             {$album.parentalbum}   
            </td>
            <td>
             {$album.title}   
            </td>
            <td>
             {$album.author}  
            </td>
            <td>
             {$album.template}  
            </td>
            <td>
             {$album.access}  
            </td>
            <td>
             {$album.mainmedia}  
            </td>
            <td>
             {$album.thumbnailsize}  
            </td>
            <td>
            <a href="{modurl modname='Mediasharex' type='user' func='modify_album' id=$album.id}">{gt text="Edit"}</a> 
            </td>
        </tr>
    {/foreach}
    </tbody>
    </table>
     {pager rowcount=$pager.numitems class="z-pager tip" limit=$pager.itemsperpage posvar='page' shift=1 }    
</div>
{adminfooter}
