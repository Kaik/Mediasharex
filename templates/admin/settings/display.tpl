{include file="admin/admin_header.tpl"}
{adminheader}
{modulelinks links=$settingslinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
<h3><i class="mediasharex-icon-tablet"> </i> {gt text="Display settings"}</h3>
</div>


<div id="mediasharex_mainsettings" class="z-clearfix">
      <div id="mediasharex_mainsettings_form_container" class="z-w60 z-formrow z-floatleft"> 
        <form id="mediasharex_mainsettings_form" class="z-form" action="{modurl modname='mediasharex' type='admin' func='settings_display_update'}" method="post" enctype="application/x-www-form-urlencoded">
            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           
            <fieldset> 
             <legend>{gt text="Previews"}</legend>
<div class="z-clearfix z-clearer" >
            <div class="z-w07 z-floatleft"><label for="mediasharex_preview">{gt text="Icon"}</label></div>
            <div class="z-w10 z-floatleft"><label for="mediasharex_preview">{gt text="Name"}</label></div>
            <div class="z-w08 z-floatleft"><label for="mediasharex_enableimporttables">{gt text="Width"}</label></div>
            <div class="z-w10 z-floatleft"><label for="mediasharex_enableimporttables">{gt text="Height"}</label></div>
            <div class="z-w30 z-floatleft"><label for="mediasharex_enableimporttables">{gt text="Icon class"}</label></div>
            <div class="z-w10 z-floatleft"><label for="mediasharex_enableimporttables">{gt text="RichM"}</label></div>
            <div class="z-w10 z-floatleft"><label for="mediasharex_enableimporttables">{gt text="Default"}</label></div>    
            <div class="z-w10 z-floatright"><label for="mediasharex_enableimporttables">{gt text="Remove"}</label></div>    

</div>
             {if $previews}
             {foreach from=$previews key=previewname item=preview}
             <div class="z-clearer">
               <div  class="z-w07 z-floatleft" ><i class="{$preview.class}"> </i></div>
               <input class="z-w10" id="mediasharex_preview_{$previewname}" name="previews[{$previewname}][name]"       type="text"      value="{$previewname}" />                        
               <input class="z-w05" id="mediasharex_preview_{$previewname}" name="previews[{$previewname}][width]"      type="text"      value="{$preview.width}"/>                          
               <input class="z-w05" id="mediasharex_preview_{$previewname}" name="previews[{$previewname}][height]"     type="text"      value="{$preview.height}" />                        
               <input class="z-w30" id="mediasharex_preview_{$previewname}" name="previews[{$previewname}][class]"      type="text"      value="{$preview.class}"/>  
               <input class="z-w10" id="mediasharex_preview_{$previewname}" name="previews[{$previewname}][richmedia]"  type="checkbox"  value="1"  {if $preview.richmedia}checked="checked"{/if} />                        
               <input class="z-w10" id="mediasharex_preview_{$previewname}" name="previews[{$previewname}][default]"    type="checkbox"     value="1"  {if $preview.default}checked="checked"{/if} />                        
               <input class="z-w10 z-right" id="mediasharex_preview_{$previewname}" name="previews[{$previewname}][remove]"    type="checkbox"   value="1" />                        
              </div>
            {/foreach}
            {/if}
            <p><i class="mediasharex-icon-plus-sign"> </i>  {gt text="Add new preview"}</p>
             <div>
               <div  class="z-w07 z-floatleft" ><i class="mediasharex-icon-file-alt"> </i></div>             
               <input class="z-w10" id="mediasharex_preview_new" name="new_preview[name]"       type="text"      value=""/>                        
               <input class="z-w05" id="mediasharex_preview_new" name="new_preview[width]"      type="text"      value=""/>                          
               <input class="z-w05" id="mediasharex_preview_new" name="new_preview[height]"     type="text"      value=""/>                        
               <input class="z-w30" id="mediasharex_preview_new" name="new_preview[class]"      type="text"      value=""/>  
               <input class="z-w10" id="mediasharex_preview_new" name="new_preview[richmedia]"  type="checkbox"  value=""/>                        
               <input class="z-w10" id="mediasharex_preview_new" name="new_preview[default]"    type="radio"     value=""/>                        
              </div>                        
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
      
{*zdebug*}
{adminfooter}
