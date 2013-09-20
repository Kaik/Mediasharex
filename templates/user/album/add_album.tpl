{include file="user/header.tpl"}

{* some texts *}
{gt  assign=title_holder text="You can add title here"}

<div id="mediasharex" class="z-clearfix">
    
        <h1> {gt text="Add album"}</h1>

    <p id="top"> </p>        
<div id="mediasharex_add_album" class="z-clearfix">
    
    {*albumtree tree=$tree_arr *}
    
    {breadcrumbs path=$bread crumbsId="mediasharex-plugin-breadcrumbs" crumbsClass="mediasharex-plugin-breadcrumbs"}    
    
    
{if !$parentalbum}
<div class="z-warningmsg">
    {gt text="No paretnt album!"}
    
</div>
{/if}    
    
<div id="mediasharex_add_album_form" class="z-clearfix">
    {formerrormessage id='message'}      
    {form cssClass="z-form" enctype="multipart/form-data"}
    {modurl modname='Mediasharex' type='user' func='display' album=$id assign='redirect'}
    {formtextinput textMode="hidden" id="redirect"}
    {formtextinput textMode="hidden" id="id"}
   <div id="mediasharex_add_album_editor">  
                         
    <h3><i class="mediasharex-icon-edit"> </i> {gt text="Album details"}</h3>
        <div id="mediasharex_add_album_title" class="z-formrow">
         {formlabel for="title" __text="Title" mandatorysym=true }
           <div class="input-appened">
            {formtextinput id="title" size="35" mandatory=true maxLength="100"}
           <span class="add-on tip" title="{$title_holder}"><i class="mediasharex-icon-info-sign"> </i></span>
           </div>
            {formerrormessage id='error_title'}    
        </div>              
        {*only edit access disable or z-hide*}       
        <div id="mediasharex_add_album_urltitle" class="z-formrow z-hide">
         {formlabel for="urltitle" __text="Short url"  mandatorysym=true }
            {formtextinput id="urltitle" size="75"  mandatory=true maxLength="100"}
            {formerrormessage id='error_urltitle'}    
        </div>           
        <div id="mediasharex_add_album_category" class="z-formrow">
                 {formlabel for="Cat" __text="Category" mandatorysym=true }
                 <div class="input-appened">
                     {formcategoryselector category=$catreg.Cat id="Cat" mandatory=true selectedValue=$__CATEGORIES__.Cat.id defaultValue="0" enableDBUtil=1}
                 <span class="add-on tip" title="{$cat_holder}"><i class="mediasharex-icon-info-sign"> </i></span>
                 </div>             
                 {formerrormessage id='error_cat'}              
        </div>
        <div id="mediasharex_add_album_access" class="z-formrow">
        <label for="groups_gtype">{gt text="Access"}</label>
                 {formdropdownlist id='accesslevel' items=$access_select}
        </div>
        <div id="mediasharex_add_album_template" class="z-formrow {if !$access.moderate}  z-hide  {/if}">
        <label for="groups_gtype">{gt text="Theme"}</label>
                 {formdropdownlist id='template' items=$themes_select}
        </div>        
                      
        <div id="mediasharex_add_album_description" class="z-formrow">
            {formlabel for="description" __text="Description" }
            {formtextinput id="description" placeholder=$extendeddesc_holder cssClass="noeditor" textMode="multiline" rows="5" cols="75"}
            {formerrormessage id='error_description'} 
        </div> 
        
        
     <div class="{if !$access.moderate}  z-hide  {/if}">  
    
        
    <div id="mediasharex_add_album_owner">
    <h3><i class="mediasharex-icon-user"> </i> {gt text="Owner"}</h3>        
        <div class="z-formrow">          
            {formlabel for="author" __text="Author" mandatory=true}
            {formtextinput id="author" size="10" maxLength="20"}
        </div>
         <div class="z-formrow">          
            {formlabel for="cr_uid" __text="Creator" mandatory=true}
            {formtextinput id="cr_uid" size="10" maxLength="20"}
        </div>  
    </div>
                             
   <div id="mediasharex_add_album_dates" > 
    <h3><i class="mediasharex-icon-calendar"> </i> {gt text="Dates"}</h3>    
        <div class="z-formrow">          
            {formlabel for="lu_date" __text="Modified" mandatory=true}
            {formdateinput id="lu_date" size="20" includeTime=true maxLength="100"}
        </div>
        <div class="z-formrow">          
            {formlabel for="cr_date" __text="Created" mandatory=true}
            {formdateinput id="cr_date" size="20" includeTime=true maxLength="100"}
        </div>
   </div> 
    <div id="mediasharex_add_album_position">
    <h3><i class="mediasharex-icon-sitemap"> </i> {gt text="Position"}</h3>          
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
    <div id="mediasharex_add_album_options">
    <h3><i class="mediasharex-icon-cog"> </i> {gt text="Options"}</h3>  
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
    <div id="mediasharex_add_album_extapp">
    <h3><i class="mediasharex-icon-download-alt"> </i> {gt text="External album"}</h3>     
        <div class="z-formrow">          
            {formlabel for="extappurl" __text="App url" mandatory=true}
            {formtextinput id="extappurl" size="10" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="extappdata" __text="App data" mandatory=true}
            {formtextinput id="extappdata" size="10" maxLength="20"}
        </div>
        
                 
   </div>
    <div id="mediasharex_add_album_metadata">
    <h3><i class="mediasharex-icon-download-alt"> </i> {gt text="Album meta data"}</h3>     

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
 
  
  
     <div id="mediasharex_add_album_buttons">
       <div class="z-buttons">
        {formbutton class="mediasharex-button-back"        commandName="back"    __text="Back"}
        {formbutton class="mediasharex-button-add"      commandName="add"  __text="Add"}             
       </div>
    </div>  
  
  
  
  
{/form}
</div>
</div>
</div>
{zdebug}
{* $c_path *}
