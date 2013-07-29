{modurl modname='Mediasharex' type='user' func='display' pid=$item.pid id=$item.id assign='ogurl' fqurl="true"}
{assign var="ogtitle" value=$item.title}
{assign var="ogdesc" value=$item.teaser}
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
{assign var="ccat" value=$item.__CATEGORIES__.Cat.id}
{assign var="ctopic" value=$item.__CATEGORIES__.Topic.id}
{securityutil_checkpermission component="Dizkus::" instance="::" level="ACCESS_ADMIN" assign="isadmin"}

{include file="user/header.tpl"}
<div id="mediasharex" class="MC780 z-clearfix">
{include file="user/menu.tpl"}
{include file="user/previews.tpl"}
<div id="mediasharex_display_item" >

 <h1>{$mediaitem.title}</h1>
{include file="user/breadcrubs.tpl"}
<div>   
 {mediaitem data=$mediaitem width=780 height=780  preview="full" id="media-`$mediaitem.id`" class='full'}
</div>        
</div> 
 
</div>
{zdebug}

