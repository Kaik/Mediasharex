{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$sandhlinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}
<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-folder"></i> {gt text="Media handling"}</h3>
</div>
<div id="mediasharex_info" class="z-clearfix">
    <div id="mediasharex_info_" class="z-clearfix">
      <div id="mediasharex_install_status" class="z-w40 z-formrow z-floatleft">   
        <div class="z-formrow">
        <p><a href="{modurl modname='Mediasharex' type='admin' func='managehandlers'}" > {gt text="Media handlers"}</a>: {$mediahandlers}</p>
        <p><a href="{modurl modname='Mediasharex' type='admin' func='managesources'}" > {gt text="Sources"}</a>: {$sources}</p>
        
        </div>
      </div>
      <div class="mediashare_install_banner z-formrow z-w60 z-floatright">
           {thumb image="modules/Mediasharex/images/install_banner.jpg" tag=true width=580 height=380 mode='inset' extension='png'}                          
      </div>
      
      
      
      
      
    </div>
</div>

{adminfooter}
