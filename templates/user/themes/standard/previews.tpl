<div id="mediasharex_previews_bar" class="z-clearfix">

{if $album.parentalbum >0}
<a title="{gt text='Back'}" class="tip" href="{modurl modname=Mediasharex type=$type func=display album=$album.parentalbum }"><i class="mediasharex-icon-reply"> </i></a> 
{/if}    
    
    
    {foreach from=$previews key=preview_name item=preview}
    {if $preview_name eq $c_preview}
        <i class="{$preview.class}" style="color:#eee;"> </i>
    {else}    
        {if $album.id && $media.id}
        <a title="{gt text='Preview'} {$preview_name}" class="tip" href="{modurl modname=$module type=$type func=$func album=$album.id media=$media.id  preview=$preview_name }"><i class="{$preview.class}"> </i></a> 
        {elseif $media.id}
        <a title="{gt text='Preview'} {$preview_name}" class="tip" href="{modurl modname=$module type=$type func=$func media=$media.id  preview=$preview_name }"><i class="{$preview.class}"> </i></a> 
        {elseif $album.id}
        <a title="{gt text='Preview'} {$preview_name}" class="tip" href="{modurl modname=$module type=$type func=$func album=$album.id  preview=$preview_name }"><i class="{$preview.class}"> </i></a> 
        {/if}    
    {/if}
    {/foreach}





{if $album.access.add_media}
<a title="{gt text='Add media'}" class="tip" href="{modurl modname=Mediasharex type=$type func=add_media album=$album.id}">
  <i class="mediasharex-icon-file-add"> </i>     
</a> 
{/if}

{if $album.access.add_albums}
<a title="{gt text='Add album'}" class="tip" href="{modurl modname=Mediasharex type=$type func=add_album album=$album.id}">
  <i class="mediasharex-icon-addfolder"> </i>  
</a> 
{/if}

{if $album.access.edit}
<a title="{gt text='Edit album'}" class="tip" href="{modurl modname=Mediasharex type=$type func=modify_album id=$album.id}"><i class="mediasharex-icon-edit"> </i></a> 
{/if}

{if $album.access.access}
<a title="{gt text='Access'}" class="tip" href="{modurl modname=Mediasharex type=$type func=modify_album id=$album.id}"><i class="mediasharex-icon-key"> </i></a> 
{/if}

{if $album.access.delete}
<a title="{gt text='Delete album'}" class="tip" href="{modurl modname=Mediasharex type=$type func=modify_album id=$album.id}"><i class="mediasharex-icon-remove-circle"> </i></a> 
{/if}

</div>

