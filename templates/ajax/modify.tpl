<div id="maxcontent-nocols" style="background:#fff;" class="z-clearfix">
<div class="pagewidth780">
               
{gt text="Describe image here like author etc" assign=img_note_holder}
{gt text="This will be shown on mediasharex list" assign=shortdesc_holder}
{gt text="This will be shown on mediasharex full view" assign=extendeddesc_holder} 
{include file="user/header.tpl"}
<div id="mediasharex" class="MC780 z-clearfix">


{formerrormessage id='message'}      
{form cssClass="z-form" enctype="multipart/form-data"}
    {if $id >0}
     <h1>{gt text="Modify mediasharex"}</h1>    
    {else}
     <h1>{gt text="Add mediasharex"}</h1>    
    {/if}
<p id="top"></p>
<div id="mediasharex_ajax_blk">

   
    <h2>{gt text="Title, category, topic and image"}</h2>
        <div class="z-w60 z-floatleft">
        <div class="mediasharex_edit_title z-formrow tooltip" title="#titletooltip">
         {formlabel for="title" __text="Title" mandatorysym=true }
            {formtextinput id="title" size="45" mandatory=true maxLength="100"}
          <p id="titletooltip" style="display:none;">{gt text="You can add title here title will be checked"}</p>  
            {formerrormessage id='error_title'}    
        </div>
        {*only edit access disable or z-hide*}
        
        
        <div class="mediasharex_edit_urltitle z-formrow z-hide">
         {formlabel for="urltitle" __text="Short url"  mandatorysym=true }
            {formtextinput id="urltitle" size="45"  mandatory=true maxLength="100"}
            {formerrormessage id='error_urltitle'}    
        </div>
        
        
        <div class="mediasharex_edit_category z-formrow tooltip" title="#categorytooltip">
         {formlabel for="Cat" __text="Category" mandatorysym=true }
             {formcategoryselector category=$catreg.Cat id="Cat" mandatory=true selectedValue=$__CATEGORIES__.Cat.id defaultValue="0" enableDBUtil=1}
             {formerrormessage id='error_cat'}
         <p id="categorytooltip" style="display:none;">{gt text="Chose apropriate category"}</p>   
         </div>
        <div class="mediasharex_edit_topic z-formrow tooltip" title="#topictooltip">
         {formlabel for="Topic" __text="Topic" mandatorysym=true }
             {formcategoryselector category=$catreg.Topic id="Topic" mandatory=true selectedValue=$__CATEGORIES__.Topic.id defaultValue="0" enableDBUtil=1}
             {formerrormessage id='error_topic'}
         <p id="topictooltip" style="display:none;">{gt text="Chose apropriate topic"}</p> 
           </div> 
        <div class="mediasharex_edit_shortdesc z-formrow tooltip" title="#shortdesctooltip">
             {formlabel for="teaser" __text="Short description" mandatorysym=true } 
            {formtextinput id="teaser" placeholder=$shortdesc_holder textMode="multiline" mandatory=true rows="5" cols="65"}
            {formerrormessage id='error_teaser'}
            <p id="shortdesctooltip" style="display:none;">{gt text="You can add short description"}</p>  
        </div>                                                
        </div>    
        <div class="z-w35 z-floatright">       
            
            {if $img.file_name}
            <div id="mediasharex_edit_img" class="tooltip" title="#imgtooltip"> 
            <img class="mediasharex_itemimg" src="MContent_files/Mediasharex/{$img.file_name}" />
            </div>           
            {elseif $post_img.img_ajax.file_name}
            <div id="mediasharex_edit_img" class="tooltip" title="#imgtooltip">  
            <img class="mediasharex_itemimg" src="MContent_files/Mediasharex/{$post_img.img_ajax.file_name}" /> 
            </div>                     
            {else}
            <div id="mediasharex_edit_img" class="tooltip" title="#newimgtooltip">     
            {img modname='Mediasharex' src=add_image.png }
            </div>       
            {/if}
            <p id="imgtooltip" style="display:none;">{gt text="Click on delete button to change image"}</p>  
            <p id="newimgtooltip" style="display:none;">{gt text="Click on button below to add image"}</p>  

            
             
            <div id="mediasharex_edit_img_note_box" class="mediasharex_edit_img_note z-formrow {if $img.file_name}  {elseif $post_img.img_ajax.file_name}      {else}  z-hide     {/if}">
            {formtextinput id="img_note" size="45" placeholder=$img_note_holder  maxLength="100"}
            </div>
            
            {formtextinput id="img_ajax" text=$img_ajax size="25" cssClass="z-hide"  dataBased=true dataField='post_img'  maxLength="600"}
            <div id="mediasharex_edit_img_box"  class="mediasharex_edit_image z-formrow {if $img.file_name} z-hide  {elseif $post_img.img_ajax.file_name} z-hide  {else}    {/if}"> 
            {formuploadinput id="img" }
            {formerrormessage id='error_img'}    
            </div>         
            <div id="progress" class="z-hide">
            <div class="bar" style="width: 0%;"></div>
            </div>         
            <div id="mediasharex_edit_img_delete_box" class=".delete_image_button {if $img.file_name}  {elseif $post_img.img_ajax.file_name}      {else}  z-hide     {/if}" >
            <a href="#" id="mediasharex_edit_img_delete" >{gt text="Delete image"}</a>  
            </div>
            
            
            
            
             
        </div>
                
    <div class="z-formrow"> 
        <a href="#" id="mediasharex_edit_extdesc_add">       
        <h3 class="z-clearer">{gt text="Add extended text +"}</h3>
        </a>            
        <div id="mediasharex_edit_extendeddesc" class="mediasharex_edit_extendeddesc">
                          
            {notifydisplayhooks eventname='mediasharex.ui_hooks.editor.display_view' id='content' }
            {formtextinput id="content" placeholder=$extendeddesc_holder textMode="multiline" rows="10" cols="65"}
            {formerrormessage id='error_content'} 
        </div>



    {if $edit}       
    <a href="#" id="mediasharex_edit_options_add">           
    <h3>{gt text="Editor settings"}</h3>
    </a>
    <div id="mediasharex_edit_options_box" class="z-formrow">
    <div id="mediasharex_edit_author_col" class="MC180 z-floatleft">      
        
        <div class="z-formrow">          
            {formlabel for="author" __text="Author" mandatory=true}
            {formtextinput id="author" size="10" maxLength="20"}
        </div>
         <div class="z-formrow">          
            {formlabel for="cr_uid" __text="Creator" mandatory=true}
            {formtextinput id="cr_uid" size="10" maxLength="20"}
        </div>
    </div>             
   <div id="mediasharex_edit_dates_col" class="MC380 z-floatleft">      
        <div class="z-formrow">          
            {formlabel for="publishdate" __text="Publish date" mandatory=true}
            {formdateinput id="publishdate" size="20" includeTime=true maxLength="100"}
        </div>
        <div class="z-formrow">          
            {formlabel for="expiredate" __text="Expire date" mandatory=true}
            {formdateinput id="expiredate" size="20" includeTime=true maxLength="100"}
        </div>
        <div class="z-formrow">          
            {formlabel for="cr_date" __text="Cr date" mandatory=true}
            {formdateinput id="cr_date" size="20" includeTime=true maxLength="100"}
        </div>
   </div>      
    <div id="mediasharex_edit_states_col" class="MC180 z-floatleft">     
        <div class="z-formrow">          
            {formcheckbox id="online" size="10" maxLength="100"}
             {formlabel for="online" __text="Online" mandatory=true}
        </div>
        <div class="z-formrow">          
            {formcheckbox id="showinlist" size="10" maxLength="100"}
             {formlabel for="showinlist" __text="Show in List" mandatory=true}
        </div>
           <div class="z-formrow">          
            {formcheckbox id="showinmenu" size="10" maxLength="100"}
             {formlabel for="showinmenu" __text="Show in Menu" mandatory=true}
        </div>
   </div>         
   </div> 
     {/if}           
    <div class="mediasharex_edit_buttons">
       <div class="z-formrow">
        <input class="mediasharex_edit_button_cancel button_2" onclick="jQuery('#dialog').dialog('close');" value="{gt text='Close'}" type="button" />
        {formbutton class="mediasharex_edit_button_ok button_1"      commandName="save"  __text="Save"}             
       </div>
    </div>                        

{/form}
</div>
</div></div>