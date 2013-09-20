{include file="user/header.tpl"}
<div id="mediasharex" class="z-clearfix">
{include file="user/menu.tpl"}
{include file="user/themes/browse/previews.tpl"}
<div id="mediasharex_browse" class="z-clearfix">    
<h2>{gt text="Browse media"}</h2>

{* Include album js css etc. *}
{pageaddvar name='stylesheet' value="modules/Mediasharex/templates/user/themes/browse/css/album.css"}
{pageaddvar name='javascript' value="modules/Mediasharex/templates/user/themes/browse/js/album.js"}
{pageaddvar name="stylesheet" value="modules/Mediasharex/templates/user/themes/browse/css/previews/`$c_preview`.css"}
{pageaddvar name="javascript" value="modules/Mediasharex/templates/user/themes/browse/css/previews/`$c_preview`.js"}

<div id="mediasharex_browse_list" class="z-clearfix"> 
{foreach from=$media key=k item=mediaitem name=mediabrowser}                    
{include file="user/themes/browse/previews/media/preview_`$c_preview`.tpl"}                        
{foreachelse}
<div> {gt text="No media found"} </div>
{/foreach}
</div>    
{pager rowcount=$pager.numitems class="z-pager tip z-clearfix" limit=$pager.itemsperpage posvar='page' shift=1 }
</div>  
</div>
