        <div id="maxcontent-nocols" style="background:#fff;" class="z-clearfix">
            <div class="pagewidth780">
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

<div id="mediasharex_display_item" >
    
     <h1 id="mediasharex_display_item_title">{$item.title}</h1>
     {include file="user/itemmenu.tpl"} 
     <div id="mediasharex_display_item_info" class="MC280 z-floatleft">          
     <span class="tip" title="{gt text='Published'}"><i class="icon-time"></i> {$item.publishdate|date_format:"%H:%m %d/%m/%y"}</span>   
         &nbsp;
         <span class="tip" title="{gt text='Views'}"><i class="icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>
         &nbsp;
         <span class="tip" title="{gt text='Author'}"><i class="icon-user"></i> {usergetvar name='uname' uid=$item.author}</span>
         {if $item.online eq 0}
         <i class="icon-circle offline"></i>
         {/if}
     </div>
     <div id="mediasharex_display_item_catinfo" class="MC280 z-floatleft" >            
            <div id="mediasharex_firstcat">
            <span class="tip" title="{gt text="Range"}"><i class="icon-road"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' range=$item.__CATEGORIES__.Range.name}">&nbsp;{$item.__CATEGORIES__.Range.display_name.$lang}&nbsp;</a></span>
            <br />
            <span class="tip" title="{gt text="Category"}"><i class="icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
            </div>         
    </div>
    
    <div id="mediasharex_display_item_img" >      
         
         {foreach from=$item.img key=k item=image name=images}
         {if $smarty.foreach.images.first} 
         {thumb image="MContent_files/Mediasharex/`$image.file_name`" tag=true width=480 height=480 mode='inset' extension='png'}                
         {/if}   
         <div class="mediasharex_display_item_img_carousel z-floatleft"> 
         {thumb image="MContent_files/Mediasharex/`$image.file_name`" tag=true width=150 height=150 mode='inset' extension='png'}
         </div>         
         {/foreach}
         </div>         
         
    <div id="mediasharex_display_item_content" class="MC280 z-floatleft">
    {$item.content|nl2br}
    {fblike  height=40 width=180 float=none colorscheme=light url=$ogurl} 
    </div>

    <div id="mediasharex_display_item_bottom_data" class="MC780 z-clearfix z-clearer">
    <div id="mediasharex_display_item_saleinfo" class="z-floatleft"> 
    {if $item.price}
    <span class="tip" title="{gt text="Price"}"><i class="icon-gbp"></i> {$item.price}</span>   
    {/if}
    <span class="tip" title="{gt text="Contact name"}"><i class="icon-user"></i> {$item.contact_name}</span>
    <span class="tip" title="{gt text="Phone"}"><i class="icon-phone"></i> {$item.contact_tel}</span>
    <span class="tip" title="{gt text="Email"}"><i class="icon-envelope"></i> {$item.contact_email}</span>   
    </div>                       
    </div>      
     



        <div id="mediasharex_display_item_cats" class="MC280 z-floatright z-clearfix">
        
        </div>
 </div> 

</div></div>    
     


