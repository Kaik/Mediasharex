{include file="user/header.tpl"}

{* some texts *}
{gt  assign=title_holder text="You can add title here"}

<div id="mediasharex" class="MC780 z-clearfix">
{formerrormessage id='message'}      
{form cssClass="z-form" enctype="multipart/form-data"}
{modurl modname='Mediasharex' type='admin' func='manager_modify_media' id=$id assign='redirect'}
{formtextinput textMode="hidden" id="redirect"}
{formtextinput textMode="hidden" id="id"}
    {if $id >0}
     <div class="z-admin-content-pagetitle">
        <h1><i class="mediasharex-icon-picture"></i> {gt text="Modify media"}</h1>
    </div>   
    {else}
     <div class="z-admin-content-pagetitle">
        <h1><i class="mediasharex-icon-picture"></i> {gt text="Add media"}</h1>
    </div>   
    {/if}
    <p id="top"></p>
    <div id="mediasharex_admin_manager_modify_media_form" class="z-clearfix">

    <div id="mediasharex_admin_manager_modify_media_buttons">
       <div class="z-buttons">
        {formbutton class="mediasharex-button-back"                     commandName="back"    __text="Back"}
        {formbutton class="mediasharex-button-update z-floatright"      commandName="update"  __text="Update"}             
       </div>
    </div> 
      
<div id="mediasharex_admin_manager_modify_media_left_col" class="z-w45 z-floatleft">
 <div id="mediasharex_admin_manager_modify_media_preview" class="z-clearfix z-clearer">
          <h2>{$media.title}</h2>
          {mediaitem data=$media width=280 height=280}     
          <p>{$media.description}</p>
        <div id="mediasharex_admin_manager_modify_media_preview_info">
            <span class="tip" title="{gt text='Created'}"><i class="mediasharex-icon-time"></i> {$media.cr_date|date_format:"%H:%m %d/%m/%y"}</span>   
            &nbsp;
            <span class="tip" title="{gt text='Views'}"><i class="mediasharex-icon-eye-open"></i> {nocache}{$media.hitcount}{/nocache}</span>
            &nbsp;
            <span class="tip" title="{gt text='Handler'}"><i class="mediasharex-icon-play"></i> {$media.handler}</span> 
        </div>                     
</div> 

<div id="mediasharex_admin_manager_modify_media_previews" class="z-clearer z-clearfix">
    <h3><i class="mediasharex-icon-tablet"></i> {gt text="Saved previews"}</h3>
    <div class="mediasharex_admin_manager_modify_media_preview_item z-clearer">
     <div class="z-w20 z-floatleft">{gt text="Name"}</div> <div class="z-w20 z-floatleft">{gt text="Id"}</div>  <div class="z-w20 z-floatleft">{gt text="MimeType"}</div> <div class="z-w20 z-floatleft">{gt text="Width"}</div> <div class="z-w20 z-floatleft">{gt text="Height"} </div>
    </div> 
       
    {foreach from=$media_previews item=preview}    
    <div class="mediasharex_admin_manager_modify_media_preview_item z-clearer">
     <div class="z-w20 z-floatleft"><i class="mediasharex-icon-tablet"></i> {$preview.previewname}</div> <div class="z-w20 z-floatleft">{$preview.id}</div>  <div class="z-w20 z-floatleft">{$preview.mimetype}</div> <div class="z-w20 z-floatleft">{$preview.width}</div> <div class="z-w20 z-floatleft">{$preview.height} </div>
    </div> 
    {/foreach}
</div> 
 
 
<div class="mediasharex_admin_manager_modify_media_replace">
    <h2><i class="mediasharex-icon-repeat"></i> {gt text="Replace media"}</h2>
    {foreach from=$sources item=source}        
    {source data=$source }    
    {/foreach}
</div> 
</div>          

<div id="mediasharex_admin_manager_modify_media_editor" class="z-w45 z-floatright">              
    <h3><i class="mediasharex-icon-edit"></i> {gt text="Media details"}</h3>
        <div id="mediasharex_admin_manager_modify_media_title" class="z-formrow">
         {formlabel for="title" __text="Title" mandatorysym=true }
           <div class="input-appened">
            {formtextinput id="title" size="35" mandatory=true maxLength="100"}
           <span class="add-on tip" title="{$title_holder}"><i class="mediasharex-icon-info-sign"></i></span>
           </div>
            {formerrormessage id='error_title'}    
        </div>              
        {*only edit access disable or z-hide*}       
        <div id="mediasharex_admin_manager_modify_media_urltitle" class="z-formrow z-hide">
         {formlabel for="urltitle" __text="Short url"  mandatorysym=true }
            {formtextinput id="urltitle" size="75"  mandatory=true maxLength="100"}
            {formerrormessage id='error_urltitle'}    
        </div>           
        <div id="mediasharex_admin_manager_modify_media_category" class="z-formrow">
                 {formlabel for="Cat" __text="Category" mandatorysym=true }
                 <div class="input-appened">
                     {formcategoryselector category=$catreg.Cat id="Cat" mandatory=true selectedValue=$__CATEGORIES__.Cat.id defaultValue="0" enableDBUtil=1}
                 <span class="add-on tip" title="{$cat_holder}"><i class="mediasharex-icon-info-sign"></i></span>
                 </div>             
                 {formerrormessage id='error_cat'}              
        </div>
        <div id="mediasharex_admin_manager_modify_media_access" class="z-formrow">
        <label for="groups_gtype">{gt text="Access"}</label>
                 {formdropdownlist id='accesslevel' items=$access_select}
        </div>                           
        <div id="mediasharex_admin_manager_modify_media_description" class="z-formrow">
            {formlabel for="description" __text="Description" }
            {formtextinput id="description" placeholder=$extendeddesc_holder cssClass="noeditor" textMode="multiline" rows="5" cols="75"}
            {formerrormessage id='error_description'} 
        </div> 
    <div id="mediasharex_admin_manager_modify_media_editor_owner">
    <h3><i class="mediasharex-icon-user"></i> {gt text="Owner"}</h3>        
        <div class="z-formrow">          
            {formlabel for="author" __text="Author" mandatory=true}
            {formtextinput id="author" size="10" maxLength="20"}
        </div>
         <div class="z-formrow">          
            {formlabel for="cr_uid" __text="Creator" mandatory=true}
            {formtextinput id="cr_uid" size="10" maxLength="20"}
        </div>  
    </div>
                             
   <div id="mediasharex_admin_manager_modify_media_editor_dates" > 
    <h3><i class="mediasharex-icon-calendar"></i> {gt text="Dates"}</h3>    
        <div class="z-formrow">          
            {formlabel for="lu_date" __text="Modified" mandatory=true}
            {formdateinput id="lu_date" size="20" includeTime=true maxLength="100"}
        </div>
        <div class="z-formrow">          
            {formlabel for="cr_date" __text="Created" mandatory=true}
            {formdateinput id="cr_date" size="20" includeTime=true maxLength="100"}
        </div>
   </div> 
    <div id="mediasharex_admin_manager_modify_media_editor_position">
    <h3><i class="mediasharex-icon-sitemap"></i> {gt text="Position"}</h3>          
        <div class="z-formrow">          
            {formlabel for="parentalbum" __text="Parent album" mandatory=true}
            {formtextinput id="parentalbum" size="10" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="position" __text="Position" mandatory=true}
            {formtextinput id="position" size="10" maxLength="20"}
        </div>                
    </div>        
    <div id="mediasharex_admin_manager_modify_media_editor_options">
    <h3><i class="mediasharex-icon-cog"></i> {gt text="Options"}</h3>  
        <div class="z-formrow">          
            {formlabel for="original" __text="Original preview" mandatory=true}
            {formtextinput id="original" size="10" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="handler" __text="Media handler" mandatory=true}
            {formtextinput id="handler" size="10" maxLength="20"}
        </div>

        <div class="z-formrow">          
            {formlabel for="referenceid" __text="Reference" mandatory=true}
            {formtextinput id="referenceid" size="10" maxLength="20"}
        </div>              
   </div>
    <div id="mediasharex_admin_manager_modify_media_editor_attributies">
    <h3><i class="mediasharex-icon-download-alt"></i> {gt text="Album meta data"}</h3>     

    {if $__ATTRIBUTIES__}
    {foreach from=$__ATTRIBUTIES__ key=key item=attr}
    
         <div class="z-formrow">          
            {formlabel for="__ATTRIBUTIES__" __text="Atr name"}
            {formtextinput id="__ATTRIBUTIES__[$key][name]" size="10" maxLength="20"}
         
            {formlabel for="__ATTRIBUTIES__" __text="Atr value" mandatory=true}
            {formtextinput id="__ATTRIBUTIES__[$key][value]" size="10" maxLength="20"}         
        </div>    
    
       
    {/foreach}
    {else}
    
          <div class="z-formrow">          
            {formlabel for="__ATTRIBUTIES__" __text="Atr name"}
            {formtextinput id="__ATTRIBUTIES__[new][name]" size="10" maxLength="20"}
         
            {formlabel for="__ATTRIBUTIES__" __text="Atr value" mandatory=true}
            {formtextinput id="__ATTRIBUTIES__[new][value]" size="10" maxLength="20"}         
        </div>    
    
    {/if}
        
                 
   </div>    
   
       
   </div>                         
  </div>
{/form}
</div>
{zdebug}

