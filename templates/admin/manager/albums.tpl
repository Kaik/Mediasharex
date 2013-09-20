{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$managerlinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-folder"> </i> {gt text="Manage albums"}</h3>
</div>

<div id="mediasharex_managealbums" class="z-clearfix">


    <div class="z-w20 z-floatleft">
       {albumtree tree=$tree treeId="mediasharex-plugin-albumtree" treeClass="mediasharex-plugin-albumtree"}       
    </div>
   
    <div class="z-w70 z-floatright">
    <h4>{gt text="Album details"}</h4>
    <div >{gt text="Title"}: {$album.title}</div>
    <div >{gt text="Description"}: {$album.description}</div>
    <div >{gt text="Author"}: {$album.author}</div>
    <div >{gt text="Theme"}: {$album.template}</div>
    <div >{gt text="Create date"}: {$album.cr_date}</div>
    <div >{gt text="Last modified"}: {$album.lu_date}</div>
    <div >{gt text="Modified by"}: {$album.lu_uid}</div>
    <div >{gt text="View key"}: {$album.viewkey}</div>
    <div >{gt text="Ext app url"}: {$album.viewkey}</div>
    <div >{gt text="Ext app data"}: {$album.viewkey}</div>
    </div>   
</div>
{adminfooter}
{*zdebug*}
