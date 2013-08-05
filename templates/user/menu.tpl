{gt text="mediasharex" assign='thisname'}

<div id="mediasharex_menu" class="z-clearfix">

<ul>
<li id="mediasharex_title" class="mediasharex_menu_link">      
<a  href="{modurl modname='Mediasharex' type='user' func='home'}" > <h1><i class="mediasharex-icon-picture icon-2x"></i> {gt text="Gallery"}</h1></a>
</li>

<li id="mediasharex_home_link" class="mediasharex_menu_link">  
        <a  title="{gt text='Home'}" class="tip" href="{modurl modname='Mediasharex' type='user' func='home'}"><i class="mediasharex-icon-star mediasharex-icon-home"></i> {gt text='Home'}</a>
</li>  
<li id="mediasharex_browse_link" class="mediasharex_menu_link">  
        <a  title="{gt text='Browse'}" class="tip" href="{modurl modname='Mediasharex' type='user' func='view'}"><i class="mediasharex-icon-star mediasharex-icon-eye-open"></i> {gt text='Browse'}</a>
</li> 
<li id="mediasharex_explore_link" class="mediasharex_menu_link">  
        <a  title="{gt text='Explore'}" class="tip" href="{modurl modname='Mediasharex' type='user' func='display'}"><i class="mediasharex-icon-sitemap mediasharex-icon-large"></i> {gt text='Explore'}</a>
</li> 



{if $coredata.logged_in eq 1}
    <li id="mediasharex_add_link" class="mediasharex_menu_link">  
        <a  title="{gt text='Add media'}" class="tip" href="{modurl modname='Mediasharex' type='user' func='add_media'}"><i class="mediasharex-icon-plus mediasharex-icon-large"></i> {gt text='Add media'}</a>
    </li> 
    <li id="mediasharex_my_link" class="mediasharex_menu_link">
    <a  title="{gt text='My album'}" class="tip" href="{modurl modname='Mediasharex' type='user' func='my_album'}">
     <i class="mediasharex-icon-folder-close-alt mediasharex-icon-large"></i> {gt text='My album'}</a>
    </li>
    <li id="mediasharex_status_link" class="mediasharex_menu_link">
    </li>  
{else}
    <li id="mediasharex_add_link" class="mediasharex_menu_link"> 
        <a  title="{gt text='Add media'}" class="tip" href="{modurl modname='Mediasharex' type='user' func='add_media'}"><i class="mediasharex-icon-plus mediasharex-icon-large"></i> {gt text='Add media'}</a>
    </li> 
{/if}

</ul>
                      
                  
</div>

