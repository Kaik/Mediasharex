	<div id="mediasharex_cats_vertical" class="MC180 z-floatleft">
	<h2>{gt text="Categories"}</h2>
    <ul id="mediasharex_cats">
    {foreach from=$cats item=category}
    <li {if $ccat.id == $category.id}id="current_cat"{/if}><a href="{modurl modname='Mediasharex' type='user' func='view' topic=$ctopic.name category=$category.name}">{$category.display_name.$lang}</a></li>
    {/foreach}
    </ul>
    </div>
    
    <div id="mediasharex_topics_vertical" class="MC580 z-floatright">
	<h2>{gt text="Topics"}</h2>
    {foreach from=$topics item=topic name=topicsloop}
    {if $smarty.foreach.topicsloop.first}
    <ul id="mediasharex_topics1" class="mediasharex_topicsv MC180 z-floatleft">
    <li {if $ctopic.id == $topic.id}id="current_topic"{/if}><a href="{modurl modname='Mediasharex' type='user' func='view' topic=$topic.name category=$ccat.name}">{$topic.display_name.$lang}</a></li>
    
    {elseif $smarty.foreach.topicsloop.index eq 3}
    <li {if $ctopic.id == $topic.id}id="current_topic"{/if}><a href="{modurl modname='Mediasharex' type='user' func='view' topic=$topic.name category=$ccat.name}">{$topic.display_name.$lang}</a></li>
    </ul>
    <ul id="mediasharex_topics2" class="mediasharex_topicsv MC180 z-floatleft">
    {elseif $smarty.foreach.topicsloop.index eq 7}
    <li {if $ctopic.id == $topic.id}id="current_topic"{/if}><a href="{modurl modname='Mediasharex' type='user' func='view' topic=$topic.name category=$ccat.name}">{$topic.display_name.$lang}</a></li>
    </ul>
    <ul id="mediasharex_topics3" class="mediasharex_topicsv MC180 z-floatleft">
    
    {elseif $smarty.foreach.topicsloop.last}
    <li {if $ctopic.id == $topic.id}id="current_topic"{/if}><a href="{modurl modname='Mediasharex' type='user' func='view' topic=$topic.name category=$ccat.name}">{$topic.display_name.$lang}</a></li>
    </ul>
    
    
    {else}
    <li {if $ctopic.id == $topic.id}id="current_topic"{/if}><a href="{modurl modname='Mediasharex' type='user' func='view' topic=$topic.name category=$ccat.name}">{$topic.display_name.$lang}</a></li>
    {/if}
    
    
    
    
    {/foreach}
    </div>