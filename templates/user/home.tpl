{include file="user/header.tpl"}
{pageaddvar name="stylesheet" value="modules/Mediasharex/styles/home.css"}
<div id="mediasharex" class="z-clearfix">
{include file="user/menu.tpl"}
<div id="mediasharex_home" class="z-clearfix">    

<div class="z-clearfix">
<div class="mediasharex_home_media_big z-clearfix">
{mediaitem data=$new_items.0   width=580  height=390  id="media-`$new_items.0.id`" richmedia=true class='big'}    
<div class="mediasharex_home_media_big_info">
<span class="tip" title="{gt text='Album'}">    <i class="mediasharex-icon-folder-close"> </i>   <a href="{modurl modname='Mediasharex' type='user' func='display' album=$new_items.0.parentalbum}">&nbsp;{$new_items.0.album_title}&nbsp;</a></span>   
<span class="tip" title="{gt text='Category'}"> <i class="mediasharex-icon-sitemap"> </i>        <a href="{modurl modname='Mediasharex' type='user' func='view' category=$new_items.0.__CATEGORIES__.Cat.name}">&nbsp;{$new_items.0.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}">   <i class="mediasharex-icon-user"> </i>           {usergetvar name='uname' uid=$new_items.0.author}</span>
<span class="tip" title="{gt text='Views'}">    <i class="mediasharex-icon-eye-open"> </i>       {nocache}{$new_items.0.hitcount}{/nocache}</span>      
</div>
</div>
<div class="mediasharex_home_media_left z-clearfix">
 {mediaitem data=$new_items.1  width=180 height=150 id="media-`$new_items.[1].id`"  richmedia=true class='thumbnail'}   
<div class="mediasharex_home_media_left_info">
<span class="tip" title="{gt text='Album'}">    <i class="mediasharex-icon-folder-close"> </i>   <a href="{modurl modname='Mediasharex' type='user' func='display' album=$new_items.1.parentalbum}">&nbsp;{$new_items.1.album_title}&nbsp;</a></span>     
<span class="tip" title="{gt text='Category'}"> <i class="mediasharex-icon-sitemap"> </i>        <a href="{modurl modname='Mediasharex' type='user' func='view' category=$new_items.1.__CATEGORIES__.Cat.name}">&nbsp;{$new_items.1.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}">   <i class="mediasharex-icon-user"> </i>           {usergetvar name='uname' uid=$new_items.1.author}</span>
<span class="tip" title="{gt text='Views'}">    <i class="mediasharex-icon-eye-open"> </i>       {nocache}{$new_items.1.hitcount}{/nocache}</span>      
</div>
</div>
<div class="mediasharex_home_media_left z-clearfix">
 {mediaitem data=$new_items.2 width=180 height=150  id="media-`$new_items[2]id`"  richmedia=true class='thumbnail'}    
<div class="mediasharex_home_media_left_info">
<span class="tip" title="{gt text='Album'}">    <i class="mediasharex-icon-folder-close"> </i>   <a href="{modurl modname='Mediasharex' type='user' func='display' album=$new_items.2.parentalbum}">&nbsp;{$new_items.2.album_title}&nbsp;</a></span>     
<span class="tip" title="{gt text='Category'}"> <i class="mediasharex-icon-sitemap"> </i>        <a href="{modurl modname='Mediasharex' type='user' func='view' category=$new_items.2.__CATEGORIES__.Cat.name}">&nbsp;{$new_items.2.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}">   <i class="mediasharex-icon-user"> </i>           {usergetvar name='uname' uid=$new_items.2.author}</span>
<span class="tip" title="{gt text='Views'}">    <i class="mediasharex-icon-eye-open"> </i>       {nocache}{$new_items.2.hitcount}{/nocache}</span>      
</div>
</div>
<div class="mediasharex_home_media_left z-clearfix">
  {mediaitem data=$new_items.3 width=180 height=150  id="media-`$new_items[3]id`" richmedia=true class='thumbnail'}   
<div class="mediasharex_home_media_left_info">
<span class="tip" title="{gt text='Album'}">    <i class="mediasharex-icon-folder-close"> </i>   <a href="{modurl modname='Mediasharex' type='user' func='display' album=$new_items.3.parentalbum}">&nbsp;{$new_items.3.album_title}&nbsp;</a></span>     
<span class="tip" title="{gt text='Category'}"> <i class="mediasharex-icon-sitemap"> </i>        <a href="{modurl modname='Mediasharex' type='user' func='view' category=$new_items.3.__CATEGORIES__.Cat.name}">&nbsp;{$new_items.3.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}">   <i class="mediasharex-icon-user"> </i>           {usergetvar name='uname' uid=$new_items.3.author}</span>
<span class="tip" title="{gt text='Views'}">    <i class="mediasharex-icon-eye-open"> </i>       {nocache}{$new_items.3.hitcount}{/nocache}</span>      
</div>
</div>
</div>


<div class="z-clearer">
<div class="mediasharex_home_media_left z-clearfix">
 {mediaitem data=$new_items.4 width=180 height=150  id="media-`$new_items[4]id`"  richmedia=true class='thumbnail'}    
<div class="mediasharex_home_media_left_info">
<span class="tip" title="{gt text='Album'}">    <i class="mediasharex-icon-folder-close"> </i>   <a href="{modurl modname='Mediasharex' type='user' func='display' album=$new_items.4.parentalbum}">&nbsp;{$new_items.4.album_title}&nbsp;</a></span>     
<span class="tip" title="{gt text='Category'}"> <i class="mediasharex-icon-sitemap"> </i>        <a href="{modurl modname='Mediasharex' type='user' func='view' category=$new_items.4.__CATEGORIES__.Cat.name}">&nbsp;{$new_items.4.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}">   <i class="mediasharex-icon-user"> </i>           {usergetvar name='uname' uid=$new_items.4.author}</span>
<span class="tip" title="{gt text='Views'}">    <i class="mediasharex-icon-eye-open"> </i>       {nocache}{$new_items.4.hitcount}{/nocache}</span>      
</div>
</div>
<div class="mediasharex_home_media_left z-clearfix">
  {mediaitem data=$new_items.5 width=180 height=150  id="media-`$new_items[5]id`" richmedia=true class='thumbnail'}   
<div class="mediasharex_home_media_left_info"> 
<span class="tip" title="{gt text='Album'}">    <i class="mediasharex-icon-folder-close"> </i>   <a href="{modurl modname='Mediasharex' type='user' func='display' album=$new_items.5.parentalbum}">&nbsp;{$new_items.5.album_title}&nbsp;</a></span>    
<span class="tip" title="{gt text='Category'}"> <i class="mediasharex-icon-sitemap"> </i>        <a href="{modurl modname='Mediasharex' type='user' func='view' category=$new_items.5.__CATEGORIES__.Cat.name}">&nbsp;{$new_items.5.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}">   <i class="mediasharex-icon-user"> </i>           {usergetvar name='uname' uid=$new_items.5.author}</span>
<span class="tip" title="{gt text='Views'}">    <i class="mediasharex-icon-eye-open"> </i>       {nocache}{$new_items.5.hitcount}{/nocache}</span>      
</div>
</div>
<div class="mediasharex_home_media_left z-clearfix">
  {mediaitem data=$new_items.6 width=180 height=150  id="media-`$new_items[6]id`" richmedia=true class='thumbnail'}   
<div class="mediasharex_home_media_left_info">
<span class="tip" title="{gt text='Album'}">    <i class="mediasharex-icon-folder-close"> </i>   <a href="{modurl modname='Mediasharex' type='user' func='display' album=$new_items.6.parentalbum}">&nbsp;{$new_items.6.album_title}&nbsp;</a></span>    
<span class="tip" title="{gt text='Category'}"> <i class="mediasharex-icon-sitemap"> </i>        <a href="{modurl modname='Mediasharex' type='user' func='view' category=$new_items.6.__CATEGORIES__.Cat.name}">&nbsp;{$new_items.6.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}">   <i class="mediasharex-icon-user"> </i>           {usergetvar name='uname' uid=$new_items.6.author}</span>
<span class="tip" title="{gt text='Views'}">    <i class="mediasharex-icon-eye-open"> </i>       {nocache}{$new_items.6.hitcount}{/nocache}</span>      
</div>
</div>
</div>




</div>
</div>
{*zdebug*}
