    <div class="mediasharex_block_list_item">
    {if $item.img.0.file_name neq ''}       
    <a href="{$itemurl}" >
    <div class="mediasharex_block_list_item_imgcontainer" >   
    {thumb image="MContent_files/Mediasharex/`$item.img.0.file_name`" tag=true width=100 height=100 mode='inset' extension='png'}
    </div>
    </a>
    {/if}
    <a class="mediasharex_block_list_item_title" href="{$itemurl}" >{$item.title} </a>  
    <div class="mediasharex_block_list_item_icons">
    <span class="tip" title="{gt text='Published'}"><i class="icon-time"></i> {$item.publishdate|date_format:"%H:%m %d/%m/%y"}</span>   
    &nbsp;
    <span class="tip" title="{gt text='Views'}"><i class="icon-eye-open"></i> {nocache}{$item.hitcount}{/nocache}</span>
   {if $item.price}
    <br />
    <span class="tip" title="{gt text="Price"}"><i class="icon-gbp"></i> {$item.price}
    {/if}
    <br />
    <span class="tip" title="{gt text="Range"}"><i class="icon-road"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' range=$item.__CATEGORIES__.Range.name}">&nbsp;{$item.__CATEGORIES__.Range.display_name.$lang}&nbsp;</a></span>

    <span class="tip" title="{gt text="Category"}"><i class="icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span> 
    </div>
    </div>  