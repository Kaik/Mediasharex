{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$infolinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    <h3><i class="mediasharex-icon-bullhorn"> </i> {gt text="Mediasharex status"}</h3>
</div>
<div id="mediasharex_admin_info_status" class="z-clearfix">
    <div class="z-clearfix">
      <div id="mediasharex_admin_info_status_data" class="z-w60 z-formrow z-floatleft">  

        <div class="z-formrow">
        <h3>{gt text="Module informations"}</h3>
        <p>{gt text="Version"}: {$modinfo.version}</p>

        </div>
        <div class="z-formrow">
        <h3>{gt text="Enviroment"}</h3>
        <h5>{gt text="Php settings"}</h5>        
        <p>{gt text="File uploads"}: {if $php_vars.file_uploads} <i class="mediasharex-icon-ok-sign"> </i> {gt text="Upload is allowed"} {elseif $php_vars.file_uploads == false} <i class="mediasharex-icon-remove-sign"> </i> {gt text="Upload not allowed only externall data mode"}{/if}</p> 
        <p>{gt text="Upload max filesize"}: {$php_vars.upload_max_filesize}</p>
        <p>{gt text="POST max filesize"}: {$php_vars.post_max_size}</p>
        <p>{gt text="Max file uploads"}: {$php_vars.max_file_uploads}</p>
        </div>        
        <div class="z-formrow">
        <h3>{gt text="Module settings"}</h3>
        <p>{gt text="Temp directory"}: {$modulevars.general_tmpDirName} {if $dir_check.general_tmpDirName.writable} <i class="mediasharex-icon-ok-sign"> </i> {gt text="Directory exist and is writable"} {elseif $dir_check.general_tmpDirName.writable == false} <i class="mediasharex-icon-remove-sign"> </i> {gt text="Directory not exist or is not writable"}{/if}</p> 
        <p>{gt text="Media directory"}: {$modulevars.general_mediaDirName} {if $dir_check.general_mediaDirName.writable} <i class="mediasharex-icon-ok-sign"> </i> {gt text="Directory exist and is writable"} {elseif $dir_check.general_mediaDirName.writable == false} <i class="mediasharex-icon-remove-sign"> </i> {gt text="Directory not exist or is not writable"}{/if}</p> 
        
        <p><a href="{modurl modname='Mediasharex' type='admin' func='settings_general'}" >{gt text="Edit settings"}</a>         
        </p>
        </div>
        
        <div class="z-formrow">
        <h3>{gt text="Content"}</h3>
        <p><a href="{modurl modname='Mediasharex' type='admin' func='manager_albums'}" >{gt text="Albums"}</a>: {$albums}</p>
        <p><a href="{modurl modname='Mediasharex' type='admin' func='manager_media'}" > {gt text="Media"}</a>: {$media}</p>
        <p><a href="{modurl modname='Mediasharex' type='admin' func='sandh_handlers'}" > {gt text="Media handlers"}</a>: {$mediahandlers}</p>
        <p><a href="{modurl modname='Mediasharex' type='admin' func='sandh_sources'}" > {gt text="Sources"}</a>: {$sources}</p>
        
        </div>
      </div>
      <div id="mediasharex_admin_documentation" class="mediasharex_admin_documentation z-formrow z-w35 z-floatright">
      {$file_content}
      </div>
      
      
      
      
      
    </div>
</div>

{adminfooter}
{*zdebug*}
