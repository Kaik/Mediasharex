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
{include file="user/header.tpl"}
<div id="mediasharex" class="MC780 z-clearfix">
{include file="user/menu.tpl"}
{include file="user/previews.tpl"}
<div id="mediasharex_display_album" >
<div id="mediasharex_display_item" >

 <h1>{$album.title}</h1>
 <div class="">
<i class="icon-folder-open"></i> {$album.title}      
 </div>        
</div>     
  {if $mediaitems|@count >0}
  <div id="mediasharex_display_mediaitems" class="z-clearfix z-clearer">
  <h3>{gt text="Media items"}</h3>  
  {foreach from=$mediaitems item=mediaitem}
  <div class="display_mediaitem MC180 z-floatleft">
    {modurl assign=url modname=Mediasharex type=user func=display album=$mediaitem.parentalbum media=$mediaitem.id}
    {mediaitem data=$mediaitem width=140 url=$url height=90 preview='thumbnail'}
   <p>{$mediaitem.title}</p> 
  </div>
  {/foreach}
  </div>
  {/if}  
  {if $subalbums|@count >0}
  <div id="mediasharex_display_subalbums" class="z-clearfix z-clearer">
  <h3>{gt text="Albums"}</h3>  
  {foreach from=$subalbums item=subalbum}
  <div class="mediasharex_display_subalbum MC180 z-floatleft">
   <div class="icon-folder-close " style="font-size:180px"></div>   
   {modurl assign=url modname=Mediasharex type=user func=display album=$subalbum.id}
   {album data=$subalbum width=140 url=$url height=90 preview='thumbnail'}          
   <p>{$subalbum.title}</p>   
  </div>
  {/foreach}
  </div>
  {/if}
</div> 
</div>
{zdebug}

