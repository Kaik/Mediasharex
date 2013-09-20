
{* OG header  *}
{modurl modname='Mediasharex' type='user' func='display' album=$album.id assign='ogurl' fqurl="true"}
{assign var="ogtitle" value=$album.title}
{assign var="ogdesc" value=$album.description}
{assign var="ogtype" value='article'}
{assign var="ogimage_path" value=http://www.mojeleicester.pl/MContent_files/Mediasharex/}
{assign var="ogimage_file" value=$item.img.tmb_name}
{assign var="ogimage" value=$ogimage_path$ogimage_file}
{pageaddvar name="header" value="<meta property='og:title' content='$ogtitle' />"}
{pageaddvar name="header" value="<meta property='og:image' content='$ogimage' />"}
{pageaddvar name="header" value="<meta property='og:type' content='$ogtype' />"}
{pageaddvar name="header" value="<meta property='og:description' content='$ogdesc' />"}
{pageaddvar name="header" value="<meta property='fb:admins' content='100000160712484' />"}
{pageaddvar name="header" value="<meta property='fb:app_id' content='189868131069252' />"}

{* Include base js css etc. *}
{include file="user/header.tpl"}

{* Include album js css etc. *}
{pageaddvar name='stylesheet' value="modules/Mediasharex/templates/user/themes/`$album.template`/css/album.css"}
{pageaddvar name='javascript' value="modules/Mediasharex/templates/user/themes/`$album.template`/js/album.js"}
{pageaddvar name="stylesheet" value="modules/Mediasharex/templates/user/themes/`$album.template`/css/previews/`$c_preview`.css"}
{pageaddvar name="javascript" value="modules/Mediasharex/templates/user/themes/`$album.template`/css/previews/`$c_preview`.js"}


<div id="mediasharex" class="z-clearfix">

{* Include base js css etc. *}
{include file="user/menu.tpl"}

{* Include previews. *}
{include file="user/themes/`$album.template`/previews.tpl"}

   {breadcrumbs path=$bread crumbsId="mediasharex-plugin-breadcrumbs" crumbsClass="mediasharex-plugin-breadcrumbs" }  

<div id="mediasharex_display_album" >
 <h1>{$album.title}</h1>
<div id="mediasharex_display_album_description" class="">
    {$album.description}
</div>

<div id="mediasharex_display_album_media" class="z-clearer z-clearfix">       
  {if $mediaitems|@count >0}
  <h3>{gt text="Media"}</h3>  
  {foreach from=$mediaitems item=mediaitem}
  {include file="user/themes/`$album.template`/previews/media/preview_`$c_preview`.tpl"}
  {/foreach}
  {/if} 
</div>     


<div id="mediasharex_display_album_albums" class="z-clearer z-clearfix"> 
  {if $subalbums|@count >0}
  <h3>{gt text="Albums"}</h3>  
  {foreach from=$subalbums item=subalbum}
  {include file="user/themes/`$album.template`/previews/album/preview_`$c_preview`.tpl"}  
  {/foreach}
  {/if}
</div> 


</div>
</div>
{zdebug}

