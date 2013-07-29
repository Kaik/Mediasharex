{pageaddvar name='stylesheet' value='modules/Mediasharex/styles/mediasharex.css'}
<a id="mediasharex_block_list_title" href="{modurl modname='Mediasharex' type='user' }"><h2>{gt text="Mediasharex"}</h2></a>
<div id="mediasharex_blocklist" class="">
         {include file="user/block_range_cat.tpl"}   	  
   {foreach from=$items key=k item=item name=mediasharex}
       
       {if $item.online eq 0}
       {modurl modname='Mediasharex' type='user' func='display' id=$item.id pid=$item.pid assign=itemurl} 
       {else}   
       {modurl modname='Mediasharex' type='user' func='display' id=$item.id urltitle=$item.urltitle assign=itemurl} 
       {/if}
   
       {if $smarty.foreach.mediasharex.first}       
       {include file="user/block_listitem.tpl"}      
       {else}  	   	
       {include file="user/block_listitem.tpl"}   	  	
   	   {/if}

   {foreachelse}
   <div class=""> 
     <span>{gt text="No mediasharex found"}</span>
   </div>
   {/foreach}
 </div>