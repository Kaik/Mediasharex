{include file="admin/admin_header.tpl"}
{adminheader}
<div id="mediasharex_admin_sandh_modify_handler" class="z-clearfix">
{formerrormessage id='message'}      
{form cssClass="z-form" enctype="multipart/form-data"}
{modurl modname='Mediasharex' type='admin' func='sandh_handlers' assign='redirect'}
{formtextinput textMode="hidden" id="redirect"}
{formtextinput textMode="hidden" id="source_name"}




     <div class="z-admin-content-pagetitle">
        <h1><i class="mediasharex-icon-folder"> </i> {gt text="Modify source settings"}</h1>
    </div>   

    <p id="top"> </p>
    <div id="mediasharex_admin_sandh_modify_handler_form" class="z-clearfix">
      
    <div id="mediasharex_admin_sandh_modify_handler_info" class="z-w45 z-floatleft">
    <div>
          <h3>{gt text="Source info"}</h3>
            <h4 class="z-formrow" >{$source_info.name}</h4>
            <div class="z-formrow" ><strong>{gt text="Version"}:</strong>  {$source_info.version} <strong> {gt text="Author"}:</strong>  {$source_info.author}</div>         
    </div>
    <div>
    <h3>{gt text="Supported media types"}</h3>

    <table id="mediasharex_admin_sandh_modify_handler_supported_mediatypes" class="z-datatable">
    <thead>
    <tr>
    <th>
    <span class="z-nowrap">{gt text="MimeType"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="File type"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Internal MimeType"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Internal File type"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Active"}</span>
    </th>
    </tr>
    </thead>
    <tbody>
     {foreach from=$handler_info.mimeTypes item=item}
        <tr >
            <td>
             {$item.mimetype}  
            </td>
            <td>
             {$item.filetype}  
            </td>
            <td>
             {$item.foundmimetype}   
            </td>
            <td>
             {$item.foundfiletype}   
            </td>
            <td>
             {$item.active}   
            </td>
        </tr>
    {/foreach}
    </tbody>
    </table>     
    </div>     
    </div>


   <div id="mediasharex_admin_manager_modify_album_editor" class="z-w45 z-floatright">              
    <h3><i class="mediasharex-icon-edit"> </i> {gt text="Handler settings"}</h3>     
    <table id="mediasharex_admin_sandh_modify_handler_settings" class="z-datatable">
    <thead>
    <tr>
    <th>
    <span class="z-nowrap">{gt text="Name"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Value"}</span>
    </th>
    <th>
    <span class="z-nowrap">{gt text="Options"}</span>
    </th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$settings key=name item=value}  
        <tr >
            <td>
            {$name}  
            </td>
            <td>
            {formtextinput id="$name" group="settings" size="10" maxLength="20"}    
            </td>
            <td>              
            </td>
        </tr>
    {foreachelse}
            <tr>
            <td class="z-center z-sub" colspan="3">
             {gt text="No settings found. Add new below."}
            </td>
        </tr> 
    {/foreach}
        <tr >
            <td>
            {formtextinput id="name" group="new_settings" size="20" maxLength="20"}
            </td>
            <td>
            {formtextinput id="value" group="new_settings" size="20" maxLength="20"}         
            </td>
            <td>              
            </td>
        </tr>        
    </tbody>
    </table>  
    <div id="mediasharex_admin_sandh_modify_handler_buttons">
       <div class="z-buttons">
        {formbutton class="mediasharex-button-back"        commandName="back"    __text="Back"}
        {formbutton class="mediasharex-button-update"      commandName="update"  __text="Update"}             
       </div>
    </div>         
 
 
 
 
                 
   </div>                                   
  </div>
{/form}
</div>
{adminfooter}
{*zdebug*}