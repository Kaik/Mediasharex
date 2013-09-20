{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$sandhlinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}
<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-folder"> </i> {gt text="Media handling"}</h3>
</div>
<div id="mediasharex_info" class="z-clearfix">
    <div id="mediasharex_info_" class="z-clearfix">
      <div id="mediasharex_install_status" class="z-w40 z-formrow z-floatleft">   
        <div class="z-formrow">
        <p><a href="{modurl modname='Mediasharex' type='admin' func='sandh_sources'}" > {gt text="Found sources"}</a>: {$sourcesFiles|@count}</p>
        <p><a href="{modurl modname='Mediasharex' type='admin' func='sandh_sources'}" > {gt text="Active sources"}</a>: {$activeSources|@count}</p>
        <p><a href="{modurl modname='Mediasharex' type='admin' func='sandh_handlers'}" > {gt text="Found handlers"}</a>: {$handlersFiles|@count}</p>
        <p><a href="{modurl modname='Mediasharex' type='admin' func='sandh_handlers'}" > {gt text="Active handlers"}</a>: {$activeHandlers|@count}</p>        
        </div>
      </div>

    </div>
</div>

{adminfooter}
