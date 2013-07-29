{include file="user/header.tpl"}
{pageaddvar name='javascript' value='modules/Mediasharex/javascript/manager.js'}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jQuery-File-Upload/js/jquery.fileupload.js"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jQuery-File-Upload/js/jquery.iframe-transport.js"}
{pageaddvar name='javascript' value='modules/Mediasharex/javascript/mediasharex_edit.js'}
{pageaddvar name='javascript' value='modules/Mediasharex/javascript/image_upload.js'}
<div id='mediasharex_indicator' class="z-window-indicator" style="display:none"></div>
<div id="dialog" title="Preview">
</div> 
<div id="manager">
   <a href="{modurl modname='Mediasharex' type='user' func='manager'}" class="tip" title="{gt text='Reload list'}"><h1>{gt text="Mediasharex manager"}</h1></a>
   {include file="user/manager_menu.tpl"} 
<table id="mediasharex_items" class="z-datatable">
    <thead>
    <tr>
    <th>
    <span class="z-nowrap">{gt text="Online"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Published"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Expire date"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Title"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Category"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Range"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Author"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Images"}</span>
    </th>
    <th>
    <span class="z-nowrap"><i class="icon-eye-open"></i></span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Modified"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="By"}</span>
    </th>
    <th>{gt text="Options"}</th>
   </tr>
    </thead>
    <tbody>
     {foreach from=$items item=item}
        <tr class="item_{$item.id}">
            {if $access.edit or $access.moderate or $access.delete}
                <td id="item_{$item.id}_state">
                    {if $item.online eq 0}
                    <a id="#{$item.id}/online"   href="#{$item.id}/online">
                    <i class="icon-circle offline"></i></a>
                    {elseif $item.online eq 1}
                    <a id="#{$item.id}/offline"   href="#{$item.id}/offline">
                    <i class="icon-circle online"></i>
                    </a>
                    {/if}
                </td>
            {else}
                <td id="item_{$item.id}_state">
                {if $item.online eq 0}
                <i class="icon-circle offline tip" title="{gt text='Offline'}"></i>
                {elseif $item.online eq 1}
                <i class="icon-circle online tip" title="{gt text='Online'}"></i>
                {/if}
                </td>
            {/if}
            
                <td  {if $smarty.now|date_format:"%Y.%m.%d" > $item.publishdate|dateformat:"%Y.%m.%d"} class="published" {elseif $smarty.now|dateformat:"%Y.%m.%d" < $item.publishdate|dateformat:"%Y.%m.%d"} class="unpublished" {/if}   >
                <span class="z-nowrap tip" title="{$item.publishdate|dateformat:"%d.%m.%y"}">
                <strong>{$item.publishdate|dateformat:"%d.%m.%y"}</strong></span>
                </td>
           
            
            
                <td  {if $smarty.now|date_format:"%Y.%m.%d" > $item.expiredate|dateformat:"%Y.%m.%d"} class="expired" {elseif $smarty.now|dateformat:"%Y.%m.%d" < $item.expiredate|dateformat:"%Y.%m.%d"} class="published" {/if}   >
                <span class="z-nowrap tip" title="{$item.expiredate|dateformat:"%d.%m.%y"}">
                <strong>{$item.expiredate|dateformat:"%d.%m.%y"}</strong></span>
                </td>
          
            <td>   
              <span class="z-nowrap tip blue" title="{$item.title}">
            {if $access.edit or $access.moderate or $access.delete} 
                <a id="#{$item.id}/modify/element/title"   href="#{$item.id}/modify/element/title">
                <i class="icon-search"></i></a>
                {$item.title|truncate:20}
            {else}
                {$item.title|truncate:20}   
            {/if}
                </span>
            </td>
            <td>
                <span class="z-nowrap">
            {if $access.edit or $access.moderate or $access.delete}
            <a id="#{$item.id}/modify/element/category"   href="#{$item.id}/modify/element/category">
            {if $item.__CATEGORIES__.Cat.name neq ''}{$item.__CATEGORIES__.Cat.name}{else}<i class="icon-plus offline"></i>{/if}
            </a>
            {else}
            {if $item.__CATEGORIES__.Cat.name neq ''}{$item.__CATEGORIES__.Cat.name}{else}<i class="icon-plus offline"></i>{/if}            
            {/if}
                </span>
            </td>
            <td>
               <span class="z-nowrap">            
            {if $access.edit or $access.moderate or $access.delete}
                <a id="#{$item.id}/modify/element/topic"   href="#{$item.id}/modify/element/topic">
                {if $item.__CATEGORIES__.Range.name neq ''}{$item.__CATEGORIES__.Range.name}{else}<i class="icon-plus offline"></i>{/if}
                </a>
                {else}
                {if $item.__CATEGORIES__.Range.name neq ''}{$item.__CATEGORIES__.Range.name}{else}<i class="icon-plus offline"></i>{/if}
            {/if}
                </span>
            </td>
            <td>
                <span class="z-nowrap">
            {if $access.edit or $access.moderate or $access.delete}
                <a id="#{$item.id}/modify/element/author"   href="#{$item.id}/modify/element/author">  
                {usergetvar name='uname' uid=$item.author}
                </a>    
            {else}
                {usergetvar name='uname' uid=$item.author}
            {/if}
                </span>
            </td>
            <td>
            <span class=" z-nowrap">    
                {foreach from=$item.img key=k item=image}      
                {if $image.file_name}                  
                    {if $access.edit or $access.moderate or $access.delete}
                    <a id="#{$item.id}/modify/element/image"   href="#{$item.id}/modify/element/image">
                    <i class="icon-circle online"></i>
                    </a>  
                    {else}
                    <i class="icon-circle online"></i>
                    {/if}
                {else}
                    {if $access.edit or $access.moderate or $access.delete}
                    <a id="#{$item.id}/modify/element/image"   href="#{$item.id}/modify/element/image">
                    <i class="icon-circle offline"></i>
                    </a>  
                    {else}
                    <i class="icon-circle offline"></i>
                    {/if}
                {/if}                   
                {/foreach}    
                
            </span>
            </td>              
            <td class="z-nowrap">
            <span class="z-nowrap">             
            {if $access.edit or $access.moderate or $access.delete}
                {$item.hitcount}
            {else}
                {$item.hitcount}
            {/if}
            </span>
            </td>
            
                        
            <td>
            <span class="z-nowrap">{$item.lu_date}</span>
            </td>
            
            <td>
            <span class="z-nowrap">{usergetvar name='uname' uid=$item.lu_uid}</span>
            </td>
            
            <td class="z-nowrap">
{if ($item.online eq 0 and $item.isowner eq 1) or $access.edit or $access.moderate or $access.delete}                                
<a id="#{$item.id}/modify"   href="{modurl modname='Mediasharex' type='user' func='modify' id=$item.id}" title="{gt text="Edit"}" >
<i class="icon-pencil"></i></a>&nbsp;
{/if}
<a id="#{$item.id}/display"   href="#{$item.id}/display" title="{gt text="View"}" >
<i class="icon-eye-open"></i></a>&nbsp;
{if $access.delete or ($item.online eq 0 and $item.isowner eq 1)}   
<a id="#{$item.id}/delete"   href="#{$item.id}/delete" title="{gt text="Delete"}" >
<i class="icon-trash"></i></a>&nbsp;
{/if}
            </td>
            
        </tr>
        {foreachelse}
        <tr class="z-datatableempty">
  <td colspan="11">{gt text="No mediasharex found"} <a  title="{gt text='add'}" href="{modurl modname=Mediasharex type=user func=modify}"><i class="icon-plus"></i> {gt text='add'}</a>
        </td>
        </tr>
        {/foreach}
    </tbody>
</table>
<p style="text-align:right;font-weight:bold;font-size:13px;">  {gt text="Count"}: {$pager.numitems} </p> 
           {pager rowcount=$pager.numitems class="z-pager tip" limit=$pager.itemsperpage posvar='page' shift=1 }
</div>
