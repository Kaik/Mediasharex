<div id="mediasharex_block_topics"  class="MC180 z-floatright">
   <ul id="mediasharex_block_ranges">
    {foreach from=$range item=range}
    <li {if $ctopic == $topic.id}id="current_range"{/if}><a href="{modurl modname='Mediasharex' type='user' func='view' range=$range.name}">{$range.display_name.$lang}</a></li>
    {/foreach}
    </ul>
    <ul id="mediasharex_block_cats">
    {foreach from=$cats item=category}
    {if $category.is_leaf}
    {else}
    <li {if $ccat == $category.id}id="current_cat"{/if}><a href="{modurl modname='Mediasharex' type='user' func='view' category=$category.name}">{$category.display_name.$lang} <i class="{$category.__ATTRIBUTES__.icon} z-floatright"></i></a></li>
    {/if}
    {/foreach}
    </ul>
  </div>