
<div id="mediasharex_modify_album" class="z-clearfix">
{formerrormessage id='message'}      
{form cssClass="z-form" enctype="multipart/form-data"}
{modurl modname='Mediasharex' type='user' func='display' album=$id assign='redirect'}
{formtextinput textMode="hidden" id="redirect"}
{formtextinput textMode="hidden" id="id"}
    {if $id >0}
     <div class="z-admin-content-pagetitle">
        <h1><i class="mediasharex-icon-folder"></i> {gt text="Modify album"}</h1>
    </div>   
    {else}
     <div class="z-admin-content-pagetitle">
        <h1><i class="mediasharex-icon-folder"></i> {gt text="Add album"}</h1>
    </div>   
    {/if}
    <p id="top"></p>
    <div id="mediasharex_admin_manager_modify_album_form" class="z-clearfix">

    <div id="mediasharex_admin_manager_modify_album_buttons">
       <div class="z-buttons">
        {formbutton class="mediasharex-button-back"        commandName="back"    __text="Back"}
        {formbutton class="mediasharex-button-update"      commandName="update"  __text="Update"}             
       </div>
    </div> 
      
    <div id="mediasharex_admin_manager_modify_album_preview" class="z-w45 z-floatleft">
          <div id="mediasharex_admin_manager_modify_album_media" class="z-clearfix z-clearer">
          <h3>{gt text="Album preview"}</h3>
  <div class="mediasharex_preview_album_thumbnail-large z-clearfix">
  <div class="mediasharex_preview_album_thumbnail-large_image_box" style="height:280px;width:280px;" >          
      <div class="mediasharex_preview_album_thumbnail-large_image_icon mediasharex-icon-folder-close" style="font-size:320px;">   
      </div>
    
      <div class="mediasharex_preview_album_thumbnail-large_image"> 
       {album data=$album width=280 height=280}     
      </div> 
  </div>  
  
    <div class="mediasharex_preview_album_thumbnail-large_bottom" style="width:280px;">
    <h3>{$album.title}</h3>
    <p>{$album.description}</p>
    <div class="mediasharex_preview_album_thumbnail-large_bottom_imfo">
         <span class="tip" title="{gt text='Published'}"><i class="icon-time"></i> {$album.cr_date|date_format:"%H:%m %d/%m/%y"}</span>   
        &nbsp;
        <span class="tip" title="{gt text='Views'}"><i class="icon-eye-open"></i> {nocache}{$album.hitcount}{/nocache}</span>
        &nbsp;
        <span class="tip" title="{gt text='Comments'}"><i class="icon-comment"></i> {$album.handler}</span> 
    </div>                
    
         
    </div>     
  </div>          
                  
          </div>                  
      {if $mediaitems|@count >0}
          <div id="mediasharex_admin_manager_modify_album_media" class="z-clearfix z-clearer">
          <h3>{gt text="Media items"}</h3>  
          {foreach from=$mediaitems item=mediaitem}
          {modurl assign=url modname=Mediasharex type=admin func=manager_modify_media id=$mediaitem.id}
          {mediaitem data=$mediaitem preview='thumbnail' width=150 height=140 }
          {/foreach}
          </div>
      {/if}  
      {if $subalbums|@count >0}
          <div id="mediasharex_admin_manager_modify_album_subalbums" class="z-clearfix z-clearer">
          <h3>{gt text="Subalbums"}</h3>  
          {foreach from=$subalbums item=subalbum}
          <div class="mediasharex_admin_manager_modify_album_subalbum z-floatleft">
            {modurl assign=url modname=Mediasharex type=admin func=manager_modify_album id=$subalbum.id}
            {album data=$subalbum preview='thumbnail' url=$url width=140 height=80}
          </div>
          {/foreach}
          </div>
      {/if}                                                                                         
  </div>


   <div id="mediasharex_admin_manager_modify_album_editor" class="z-w45 z-floatright">              
    <h3><i class="mediasharex-icon-edit"></i> {gt text="Album details"}</h3>
        <div id="mediasharex_admin_manager_modify_album_title" class="z-formrow">
         {formlabel for="title" __text="Title" mandatorysym=true }
           <div class="input-appened">
            {formtextinput id="title" size="35" mandatory=true maxLength="100"}
           <span class="add-on tip" title="{$title_holder}"><i class="mediasharex-icon-info-sign"></i></span>
           </div>
            {formerrormessage id='error_title'}    
        </div>              
        {*only edit access disable or z-hide*}       
        <div id="mediasharex_admin_manager_modify_album_urltitle" class="z-formrow z-hide">
         {formlabel for="urltitle" __text="Short url"  mandatorysym=true }
            {formtextinput id="urltitle" size="75"  mandatory=true maxLength="100"}
            {formerrormessage id='error_urltitle'}    
        </div>           
        <div id="mediasharex_admin_manager_modify_album_category" class="z-formrow">
                 {formlabel for="Cat" __text="Category" mandatorysym=true }
                 <div class="input-appened">
                     {formcategoryselector category=$catreg.Cat id="Cat" mandatory=true selectedValue=$__CATEGORIES__.Cat.id defaultValue="0" enableDBUtil=1}
                 <span class="add-on tip" title="{$cat_holder}"><i class="mediasharex-icon-info-sign"></i></span>
                 </div>             
                 {formerrormessage id='error_cat'}              
        </div>
        <div id="mediasharex_admin_manager_modify_album_access" class="z-formrow">
        <label for="groups_gtype">{gt text="Access"}</label>
                 {formdropdownlist id='accesslevel' items=$access_select}
        </div>
        <div id="mediasharex_admin_manager_modify_album_template" class="z-formrow">
        <label for="groups_gtype">{gt text="Theme"}</label>
                 {formdropdownlist id='template' items=$themes_select}
        </div>        
                      
        <div id="mediasharex_admin_manager_modify_album_description" class="z-formrow">
            {formlabel for="description" __text="Description" }
            {formtextinput id="description" placeholder=$extendeddesc_holder cssClass="noeditor" textMode="multiline" rows="5" cols="75"}
            {formerrormessage id='error_description'} 
        </div> 
    <div id="mediasharex_admin_manager_modify_album_editor_owner">
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
                             
   <div id="mediasharex_admin_manager_modify_album_editor_dates" > 
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
    <div id="mediasharex_admin_manager_modify_album_editor_position">
    <h3><i class="mediasharex-icon-sitemap"></i> {gt text="Position"}</h3>          
        <div class="z-formrow">          
            {formlabel for="parentalbum" __text="Parent album" mandatory=true}
            {formtextinput id="parentalbum" size="10" maxLength="20"}
        </div>
         <div class="z-formrow">          
            {formlabel for="nestedsetleft" __text="Left" mandatory=true}
            {formtextinput id="nestedsetleft" size="10" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="nestedsetlevel" __text="Level" mandatory=true}
            {formtextinput id="nestedsetlevel" size="10" maxLength="20"}
        </div>
         <div class="z-formrow">          
            {formlabel for="nestedsetright" __text="Right" mandatory=true}
            {formtextinput id="nestedsetright" size="10" maxLength="20"}
        </div>          
    </div>        
    <div id="mediasharex_admin_manager_modify_album_editor_options">
    <h3><i class="mediasharex-icon-cog"></i> {gt text="Options"}</h3>  
        <div class="z-formrow">          
            {formlabel for="thumbnailsize" __text="Thumbnail size" mandatory=true}
            {formtextinput id="thumbnailsize" size="10" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="viewkey" __text="View key" mandatory=true}
            {formtextinput id="viewkey" size="10" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="mainmedia" __text="Main media" mandatory=true}
            {formtextinput id="mainmedia" size="10" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="referenceid" __text="Reference" mandatory=true}
            {formtextinput id="referenceid" size="10" maxLength="20"}
        </div>              
   </div>
    <div id="mediasharex_admin_manager_modify_album_editor_extapp">
    <h3><i class="mediasharex-icon-download-alt"></i> {gt text="External album"}</h3>     
        <div class="z-formrow">          
            {formlabel for="extappurl" __text="App url" mandatory=true}
            {formtextinput id="extappurl" size="10" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="extappdata" __text="App data" mandatory=true}
            {formtextinput id="extappdata" size="10" maxLength="20"}
        </div>
        
                 
   </div>
    <div id="mediasharex_admin_manager_modify_album_editor_extapp">
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
            {formtextinput id="__ATTRIBUTIES__[][name]" size="10" maxLength="20"}
         
            {formlabel for="__ATTRIBUTIES__" __text="Atr value" mandatory=true}
            {formtextinput id="__ATTRIBUTIES__[][value]" size="10" maxLength="20"}         
        </div>    
    
    {/if}
        
                 
   </div>    
   
       
   </div>                         
  </div>
{/form}
</div>
{zdebug}
