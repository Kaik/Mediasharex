{gt text="mediasharex" assign='thisname'}

<div id="mediasharex_menu" class="z-clearfix">
<ul>
    <li id="add_link">
        {if $access.edit or $access.moderate or $access.delete}  
        <a  title="{gt text='add'}" href="#/modify"><i class="icon-plus"></i> {gt text='add'}</a>
        {else}
        <a  title="{gt text='add'}" href="{modurl modname=Mediasharex type=user func=modify}"><i class="icon-plus"></i> {gt text='add'}</a>
        {/if}   
    </li> 
</ul>
</div>