<div id="mediasharex_previews_bar" class="z-clearfix">
{foreach from=$previews key=preview_name item=preview}

{if $preview_name eq $c_preview}
<i class="{$preview.class}" style="color:#eee;"> </i>
{else}
<a href="{modurl modname=$module type=$type func=$func album=$album.id  preview=$preview_name }"><i class="{$preview.class}"> </i></a> 
{/if}
{/foreach}


<a href="{modurl modname=Mediasharex type=$type func=modify_album id=$album.id}"><i class="mediasharex-icon-edit"> </i></a> 
    

</div>

