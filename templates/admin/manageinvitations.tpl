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
    <span class="z-nowrap">{gt text="Created"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="albumId"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="viewkey"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="viewcount"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="email"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="subject"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="sender"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="expires"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="options"}</span>
    </th>
   </tr>
    </thead>
    <tbody>
    {foreach from=$Invitations item=item}
        <tr >
            <td>
             {$item.id}   
            </td>
            <td>
             {$item.created}   
            </td>
            <td>
             {$item.albumId}   
            </td>
            <td>
             {$item.viewkey}  
            </td>
            <td>
             {$item.viewcount}  
            </td>
            <td>
             {$item.email}  
            </td>
            <td>
             {$item.subject}  
            </td>
            <td>
             {$item.sender}  
            </td>
            <td>
             {$item.expires}  
            </td>
            <td>
             {gt text="Edit"}  
            </td>
        </tr>
    {/foreach}
    </tbody>
    </table>
     {pager rowcount=$pager.numitems class="z-pager tip" limit=$pager.itemsperpage posvar='page' shift=1 }   
    
</div>
{adminfooter}
