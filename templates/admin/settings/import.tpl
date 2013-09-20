{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$settingslinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    <h3><i class="mediasharex-icon-cogs"> </i> {gt text="Import settings"}</h3>
</div>


<div id="mediasharex_mainsettings" class="z-clearfix">
      <div id="mediasharex_mainsettings_form_container" class="z-w60 z-formrow z-floatleft"> 
    <form id="mediasharex_mainsettings_form" class="z-form" action="{modurl modname='mediasharex' type='admin' func='settings_import_update'}" method="post" enctype="application/x-www-form-urlencoded">

            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           
            <fieldset> 
             <legend>{gt text="Import tables"}</legend>
               <label for="mediasharex_import_enableImportTables">{gt text="Check this box to enable external tables for import"}</label>
                <input type="hidden" name="modulevars[import_enableImportTables]" value="0" />
               <input id="mediasharex_import_enableImportTables" name="modulevars[import_enableImportTables]" type="checkbox" value="1" {if $modulevars.import_enableImportTables}checked="checked"{/if} />                        
           </fieldset> 
             
              <div class="z-formbuttons z-buttons">
            <button type="submit"><i class="mediasharex-icon-redo"> </i> {gt text='Update'}</button>
            </div>
        </form>
      </div>
       <div id="mediasharex_admin_documentation" class="z-formrow z-w35 z-floatright">
      {$file_content}
      </div>
</div>      
{adminfooter}
