<div id="mediasharex_listitem_{$item.id}" class="mediasharex_listitem4r z-clearfix">
    
    <div class="mediasharex_listitem4imgcontainer">
    {if $item.img.pre_name}
    <a href="{$itemurl}" > 
    <img class="mediasharex_listitem4img" src="MContent_files/Mediasharex/{$item.img.pre_name}" />
    </a>
    {/if}
    </div>
     <div class="mediasharex_listitem4info">
     <span class="tip" title="{gt text='Published'}"><i class="icon-time"></i> {$item.publishdate|date_format:"%H:%m %d/%m/%y"}</span>   
    &nbsp;
    <span class="tip" title="{gt text='Views'}"><i class="icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>
    &nbsp;
    <span class="tip" title="{gt text='Comments'}"><i class="icon-comment"></i> {commentscount objectid=$item.id}</span>
    {if $item.online eq 0}
    <i class="icon-circle offline"></i>
    {/if}     {include file="user/itemmenu.tpl"}  
    </div> 

<a class="mediasharex_listitem4title" href="{$itemurl}" >{$item.title} </a>
                    
    <div class="mediasharex_listitem4teaser">
    {$item.teaser|strip_tags:false}
    <a class="mediasharex_listitem4readmore" href="{$itemurl}" >{gt text="read more..."} </a>  
    </div>
    
</div>