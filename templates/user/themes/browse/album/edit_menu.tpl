{gt text="mediasharex" assign='thisname'}

<div id="mediasharex_menu" class="z-clearfix">
<ul>
<li id="mediasharex_title">      
<a  href="{modurl modname='Mediasharex' type='user' func='view'}" > <h1><i class="mediasharex-icon-picture mediasharex-icon-2x"></i> {gt text="Gallery"}</h1></a>
</li> 
<li id="add_link">  
        <a  title="{gt text='Newest'}" class="tip" href="{modurl modname='Mediasharex' type='user' func='newest'}"><i class="mediasharex-icon-star mediasharex-icon-large"></i> {gt text='Newest'}</a>
</li> 

{if $coredata.logged_in eq 1}
    <li id="add_link">  
        <a  title="{gt text='Add media'}" class="tip" href="{modurl modname='Mediasharex' type='user' func='add_media'}"><i class="mediasharex-icon-plus mediasharex-icon-large"></i> {gt text='Add media'}</a>
    </li> 
    <li id="my_link">
    <a  title="{gt text='My album'}" class="tip" href="{modurl modname='Groups' type='user' func='view'}">
     <i class="mediasharex-icon-folder-close-alt mediasharex-icon-large"></i> {gt text='My album'}</a>
    </li>
    <li id="status_link">
    </li>  
{else}
    <li id="add_link"> 
        <a  title="{gt text='Add media'}" class="tip" href="{modurl modname='Mediasharex' type='user' func='add_media'}"><i class="mediasharex-icon-plus mediasharex-icon-large"></i> {gt text='Add media'}</a>
    </li> 
{/if}

</ul>
                      
                  
</div>

