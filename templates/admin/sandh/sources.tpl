{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$sandhlinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}
<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-folder"></i> {gt text="Media sources"}</h3>
</div>
<div class="z-informationmsg">
<a href="{modurl modname='Mediasharex' type='admin' func='sandh_reload_sources'}"> {icon type="regenerate" size="extrasmall"} {gt text="Reload sources"}</a> 
</div>

<div id="mediasharex_managesources">
<table id="mediasharex_managesources_table" class="z-datatable">
    <thead>
    <tr>
    <th>
    <span class="z-nowrap">{gt text="Id"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Title"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Name"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Form enc type"}</span>
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
    {foreach from=$mediaSources item=item}
        <tr >
            <td>
             {$item.id}   
            </td>
            <td>
             {$item.title}   
            </td>
            <td>
             {$item.name}   
            </td>
            <td>
             {$item.formenctype}  
            </td>
            <td>
             {$item.active}  
            </td>
            <td>
         <a href="{modurl modname='Mediasharex' type='admin' func='sandh_modify_source' id=$item.id}">{gt text="Edit"}</a> 
            </td>
        </tr>
    {/foreach}
    </tbody>
    </table>    
     {pager rowcount=$pager.numitems class="z-pager tip" limit=$pager.itemsperpage posvar='page' shift=1 }    
</div>
{adminfooter}
{*zdebug*}
