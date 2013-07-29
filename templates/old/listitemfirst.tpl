<div id="mediasharex_listitem_{$item.id}" class="mediasharex_listitemfirst z-clearfix">

<a class="mediasharex_listitemfirsttitle" href="{$itemurl}" >{$item.title} </a>
    
    <div class="mediasharex_listitemfirstimgcontainer tip" title="<i class='icon-camera'></i> {$item.img_note}">   
    {if $item.img.pre_name}
    <a href="{$itemurl}" > 
    <img class="mediasharex_listitemfirstimg" src="MContent_files/Mediasharex/{$item.img.pre_name}" />
    </a>
    <div id="mediasharex_display_item_img_note" >  

     </div>
    {/if}    
    </div>
                           
    <div class="mediasharex_listitemfirstteaser">
    {$item.teaser|truncate:170:"...":false} <br />
    <a class="mediasharex_listitemreadmore" href="{$itemurl}" >{gt text="read more..."} </a>  
    </div>
    
    <div class=" mediasharex_listitemfirstinfocontent MC480 z-floatright">
    <div id="mediasharex_firstinfo" class="MC180 z-floatright">
    <span class="tip" title="{gt text='Published'}"><i class="icon-time"></i> {$item.publishdate|date_format:"%H:%m %d/%m/%y"}</span>   
    &nbsp;
    <span class="tip" title="{gt text='Views'}"><i class="icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>
    &nbsp;
    <span class="tip" title="{gt text='Comments'}"><i class="icon-comment"></i> {commentscount objectid=$item.id}</span>
    {if $item.online eq 0}
    <i class="icon-circle offline"></i>
    {/if} 
    {include file="user/itemmenu.tpl"}
    </div>

    
    
    <div id="mediasharex_firstcat" class="z-floatleft">
    <span class="tip" title="{gt text='Category'}"><i class="icon-globe"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">{$item.__CATEGORIES__.Cat.display_name.$lang}</a></span>   
    </div>
    <div id="mediasharex_firsttopic" class="z-floatleft">
    <span class="tip" title="{gt text='Topic'}"><i class="icon-folder-close"></i><a href="{modurl modname='Mediasharex' type='user' func='view' topic=$item.__CATEGORIES__.Topic.name}">{$item.__CATEGORIES__.Topic.display_name.$lang} </a></span> 
    </div>
    
    
    
      
    </div> 
  

</div>