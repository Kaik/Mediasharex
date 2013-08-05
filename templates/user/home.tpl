{include file="user/header.tpl"}

<div id="mediasharex" class="MC780 z-clearfix">
{include file="user/menu.tpl"}
{include file="user/previews.tpl"}
<div id="mediasharex_picturewall" class="MC780 z-clearfix">    
<h2>{gt text="New media"}</h2>

<div id="mediasharex_home_picture_big" class="MC580 z-clearfix z-floatleft">
{mediaitem data=$new_items.0   width=580  height=390  id="media-`$new_items.0.id`" richmedia=true class='big'}    
<div id="mediasharex_home_picture_big_info">   
<span class="tip" title="{gt text="Category"}"><i class="mediasharex-icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}"><i class="mediasharex-icon-user"></i> {$new_items.0.author}</span>
<span class="tip" title="{gt text='Views'}"><i class="mediasharex-icon-eye-open"></i> {nocache}{$new_items.0.hitcount}{/nocache}</span>      
</div>
</div>

<div id="mediasharex_home_picture_right_1" class="mediasharex_home_pictures_right MC180 z-clearfix z-floatright">
 {mediaitem data=$new_items.1  width=180 height=150 id="media-`$new_items.1.id`" class='thumbnail'}   
<div id="mediasharex_home_picture_big_info">   
<span class="tip" title="{gt text="Category"}"><i class="mediasharex-icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}"><i class="mediasharex-icon-user"></i> {$item.author}</span>
<span class="tip" title="{gt text='Views'}"><i class="mediasharex-icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>      
</div>
</div>
<div id="mediasharex_home_picture_right_2" class="mediasharex_home_pictures_right MC180 z-clearfix z-floatright">
 {mediaitem data=$new_items.2 width=180 height=150  id="media-`$new_items[2]id`" class='thumbnail'}    
<div id="mediasharex_home_picture_big_info">   
<span class="tip" title="{gt text="Category"}"><i class="mediasharex-icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}"><i class="mediasharex-icon-user"></i> {$item.author}</span>
<span class="tip" title="{gt text='Views'}"><i class="mediasharex-icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>      
</div>
</div>
<div id="mediasharex_home_picture_right_3" class="mediasharex_home_pictures_right MC180 z-clearfix z-floatright">
  {mediaitem data=$new_items.3 width=180 height=150  id="media-`$new_items[3]id`" class='thumbnail'}   
<div id="mediasharex_home_picture_big_info">   
<span class="tip" title="{gt text="Category"}"><i class="mediasharex-icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}"><i class="mediasharex-icon-user"></i> {$item.author}</span>
<span class="tip" title="{gt text='Views'}"><i class="mediasharex-icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>      
</div>
</div>
<div id="mediasharex_home_picture_left_1" class="mediasharex_home_pictures_right MC180 z-clearfix z-floatleft">
 {mediaitem data=$new_items.4 width=180 height=150  id="media-`$new_items[4]id`" class='thumbnail'}    
<div id="mediasharex_home_picture_big_info">   
<span class="tip" title="{gt text="Category"}"><i class="mediasharex-icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}"><i class="mediasharex-icon-user"></i> {$item.author}</span>
<span class="tip" title="{gt text='Views'}"><i class="mediasharex-icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>      
</div>
</div>
<div id="mediasharex_home_picture_left_2" class="mediasharex_home_pictures_right MC180 z-clearfix z-floatleft">
  {mediaitem data=$new_items.5 width=180 height=150  id="media-`$new_items[5]id`" class='thumbnail'}   
<div id="mediasharex_home_picture_big_info">   
<span class="tip" title="{gt text="Category"}"><i class="mediasharex-icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}"><i class="mediasharex-icon-user"></i> {$item.author}</span>
<span class="tip" title="{gt text='Views'}"><i class="mediasharex-icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>      
</div>
</div>
<div id="mediasharex_home_picture_left_3" class="mediasharex_home_pictures_right MC180 z-clearfix z-floatleft">
  {mediaitem data=$new_items.6 width=180 height=150  id="media-`$new_items[6]id`" class='thumbnail'}   
<div id="mediasharex_home_picture_big_info">   
<span class="tip" title="{gt text="Category"}"><i class="mediasharex-icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
<span class="tip" title="{gt text='Author'}"><i class="mediasharex-icon-user"></i> {$item.author}</span>
<span class="tip" title="{gt text='Views'}"><i class="mediasharex-icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>      
</div>
</div>



</div>
<div id="mediasharex_picture_main" class="MC780 z-clearfix z-floatleft">
    <div id="mediasharex_groups" class="MC280 z-floatleft">
        
    <h2>{gt text="Popular pictures"}</h2>
    
    <div id="mediasharex_home_picture_popular_1" class="mediasharex_home_pictures_popular MC280 z-clearfix">
 {mediaitem data=$popular_items.0  width=280 height=150 richmedia=true id="media-`$new_items.0.id`" class='thumbnail'}          
    </div>
    <div id="mediasharex_home_picture_popular_2" class="mediasharex_home_pictures_popular MC280 z-clearfix">
 {mediaitem data=$popular_items.1  width=280 height=150 richmedia=true id="media-`$new_items.1.id`" class='thumbnail'}          
    </div>
    <div id="mediasharex_home_picture_popular_3" class="mediasharex_home_pictures_popular MC280 z-clearfix">
 {mediaitem data=$popular_items.2  width=280 height=150 richmedia=true id="media-`$new_items.2.id`" class='thumbnail'}      
    </div>
    </div>
    <div id="mediasharex_groups" class="MC280 z-floatleft">
    <h2>{gt text="Popular videos"}</h2>
    
        {foreach from=$items key=k item=item name=mediasharex}
                   
         {if $item.online eq 0}
         {modurl modname='Mediasharex' type='user' func='display' id=$item.id pid=$item.pid assign=itemurl} 
         {else}   
         {modurl modname='Mediasharex' type='user' func='display' id=$item.id urltitle=$item.urltitle assign=itemurl} 
         {/if}            
                
         {include file="user/lists/listitem_new.tpl" }                      
                              
        {foreachelse}
    <div id="mediasharex_home_video_popular_1" class="mediasharex_home_videos_popular MC280 z-clearfix">
        
    </div>
    <div id="mediasharex_home_video_popular_2" class="mediasharex_home_videos_popular MC280 z-clearfix">
        
    </div>
    <div id="mediasharex_home_video_popular_3" class="mediasharex_home_videos_popular MC280 z-clearfix">
    
    </div>
        {/foreach}
        
        {pager rowcount=$pager.numitems class="z-pager tip" limit=$pager.itemsperpage posvar='page' shift=1 }
     </div>
    <div id="mediasharex_groups" class="MC180 z-floatleft">       
        <div id="mediasharex_categories_box" class="MC280">
        <h2>{gt text="Categories"}</h2>
        <ul id="mediasharex_block_cats">
        {foreach from=$cats item=category}
        <li {if $ccat == $category.id}id="current_cat"{/if}><a href="{modurl modname='Mediasharex' type='user' func='view' category=$category.name}">{$category.display_name.$lang} <i class="{$category.__ATTRIBUTES__.icon} z-floatright"></i></a></li>
        {/foreach}
        </ul>
          
        </div>
        
    </div>
    </div>





<div id="mediasharex_wall" class="MC480 z-floatleft">
<h2>{gt text="Comments"}</h2>        
{*blockposition name=clubswall*}   
</div>

</div>
{*zdebug*}
