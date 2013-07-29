<div id="mediasharex_listitem_{$item.id}" class="mediasharex_listitem z-clearfix">
    <a class="mediasharex_listitemtitle" href="{$itemurl}" >{$item.title} </a>    


    <div class="mediasharex_listitemlogocontainer">
    <a href="{$itemurl}"> 
        {thumb image="MContent_files/Mediasharex/`$item.logo.file_name`" tag=true width=150 height=150 mode='inset' extension='png'}                
    </a>
    </div>    
    <div class="mediasharex_listitemteaser">{$item.teaser|strip_tags:false} </div>    
    
    <div class="mediasharex_listiteminfo">
    {if $item.online eq 0}
    <i class="icon-circle offline"></i>
        <br />
    {/if}
    
    <span class="tip" title="{gt text='Category'}"><i class="icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$item.__CATEGORIES__.Cat.name}">&nbsp;{$item.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
    <br />
    <span class="tip" title="{gt text='Members'}"><i class="icon-group"></i> {$item.group.members|@count}</span>
    <br />
    <span class="tip" title="{gt text='Views'}"><i class="icon-eye-open"></i> {$item.hitcount}</span>
    <br />
    <span class="tip" title="{gt text='Topics'}"><i class="icon-comments-alt"></i> {$item.forum.forum_topics}</span>
    <br />
         {if $item.__ATTRIBUTES__.gtype eq 1}
         <span class="tip" title="{gt text='Public group'}">
         <i class="icon-globe"></i>
         {elseif $item.__ATTRIBUTES__.gtype eq 2}
         <span class="tip" title="{gt text='Private group'}">
         <i class="icon-filter"></i>
         {else}
         <span class="tip" title="{gt text='Unknow group type'}">
         <i class="icon-exclamation-sign"></i>                  
         {/if}
         </span>
         {if $item.__ATTRIBUTES__.state eq 1}
         <span class="tip" title="{gt text='Group unlocked'}">
         <i class="icon-unlock"></i>
         {elseif $item.__ATTRIBUTES__.state eq 0} 
         <span class="tip" title="{gt text='Group locked'}">
         <i class="icon-lock"></i>
         {else}
         <span class="tip" title="{gt text='Group unknow'}">
         <i class="icon-lock"></i>                  
         {/if}
         </span>     
    {include file="user/itemmenu.tpl"}
    </div>   
                                 
</div>