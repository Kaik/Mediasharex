	<div class="mediasharex_block_list_item_top">	
    <a href="{$itemurl}" >
	<div class="mediasharex_block_list_item_top_imgcontainer" >   
	<img class="mediasharex_block_list_item_top_img" src="MContent_files/Mediasharex/{$item.img.pre_name}" />
	</div>
	</a>
	<div class="mediasharex_block_list_item_top_icons">
	<span class="tip" title="{gt text='Published'}"><i class="icon-time"></i> {$item.publishdate|date_format:"%H:%m %d/%m/%y"}</span>   
    &nbsp;
    <span class="tip" title="{gt text='Views'}"><i class="icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>
    &nbsp;
    <span class="tip" title="{gt text='Comments'}"><i class="icon-comment"></i> {commentscount objectid=$item.id}</span>
	</div>
    <a class="mediasharex_block_list_item_top_title" href="{$itemurl}" >{$item.title} </a> 	
    </div> 	