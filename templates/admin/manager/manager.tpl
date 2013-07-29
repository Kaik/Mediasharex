{adminheader}
{modulelinks links=$managerlinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    {icon type="info" size="small"}
    <h3>{gt text="Content"}</h3>
</div>

<div id="mediasharex_info" class="z-clearfix">
    <div id="mediasharex_info_" class="z-clearfix">
      <div id="mediasharex_install_status" class="z-w40 z-formrow z-floatleft">  
        <div class="z-formrow">
        <p><a href="{modurl modname='Mediasharex' type='admin' func='managealbums'}" >{gt text="Albums"}</a>: {$albums}</p>
        <p><a href="{modurl modname='Mediasharex' type='admin' func='manageitems'}" > {gt text="Media"}</a>: {$media}</p>
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
