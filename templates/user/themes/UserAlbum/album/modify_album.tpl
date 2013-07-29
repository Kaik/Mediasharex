{pageaddvar name="javascript" value="javascript/jquery-plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jQuery-File-Upload/js/jquery.fileupload.js"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jQuery-File-Upload/js/jquery.iframe-transport.js"}
{pageaddvar name='javascript' value='modules/Mediasharex/javascript/mediasharex_edit.js'}
{pageaddvar name='javascript' value='modules/Mediasharex/javascript/image_upload.js'}

{gt text="You can add title here" assign=title_holder}
{if $img.file_name or $post_img.img_ajax.file_name}
{gt text="To change image click on delete button below" assign=img_holder}
{else}
{gt text="To add image click on button below" assign=logo_holder}
{/if}
{gt text="Describe image here like author etc" assign=img_note_holder}
{gt text="Chose relevant category" assign=cat_holder}
{gt text="Chose relevant range" assign=topic_holder}
{gt text="Here you can add short description. If you want to add more text use Add extended text below." assign=shortdesc_holder}
{gt text="This will be shown on mediasharex full view" assign=extendeddesc_holder}


{include file="user/header.tpl"}
<div id="mediasharex" class="MC780 z-clearfix">
{formerrormessage id='message'}      
{form cssClass="z-form" enctype="multipart/form-data"}
    {if $id >0}
     <h1>{gt text="Modify album"}</h1>    
    {else}
     <h1>{gt text="Add album"}</h1>    
    {/if}
    <p id="top"></p>
<div id="mediasharex_edit" class="z-clearfix  ">
    <h3>{gt text="Title, description, category"}</h3>    
    <div id="mediasharex__edit_col1" class="MC780 z-floatleft">   
        <div class="mediasharex_edit_title z-formrow">
         {formlabel for="title" __text="Title" mandatorysym=true }
           <div class="input-appened">
            {formtextinput id="title" size="71" mandatory=true maxLength="100"}
           <span class="add-on tip" title="{$title_holder}"><i class="icon-info-sign blue"></i></span>
           </div>
            {formerrormessage id='error_title'}    
        </div>              
        {*only edit access disable or z-hide*}       
        <div class="mediasharex_edit_urltitle z-formrow z-hide">
         {formlabel for="urltitle" __text="Short url"  mandatorysym=true }
            {formtextinput id="urltitle" size="45"  mandatory=true maxLength="100"}
            {formerrormessage id='error_urltitle'}    
        </div>           
        <div class="mediasharex_edit_category z-formrow">
                 {formlabel for="Cat" __text="Category" mandatorysym=true }
                 <div class="input-appened">
                     {formcategoryselector category=$catreg.Cat id="Cat" mandatory=true selectedValue=$__CATEGORIES__.Cat.id defaultValue="0" enableDBUtil=1}
                 <span class="add-on tip" title="{$cat_holder}"><i class="icon-info-sign blue"></i></span>
                 </div>             
                 {formerrormessage id='error_cat'}              
        </div>
        <div class="z-formrow">
        <label for="groups_gtype">{gt text="Permissions"}</label>
                 {formdropdownlist id='gtype' items=$gtypes}
        </div>              
        <div id="mediasharex_edit_extendeddesc" class="mediasharex_edit_extendeddesc z-formrow">
            {formlabel for="description" __text="Description" }
            {formtextinput id="description" placeholder=$extendeddesc_holder cssClass="noeditor" textMode="multiline" rows="5" cols="75"}
            {formerrormessage id='error_description'} 
        </div>                                                                                          
  </div>

  
  
  
  
  
  
  
         
  {if $__ATTRIBUTES__.showgallery}       
  <div id="mediasharex__edit_col2_images" class="">
  <h3>{gt text="Gallery"}</h3>         
            {formtextinput id="gallery"  text=$post_gallery cssClass='z-hide'  size="25"  maxLength="600"}          
            {formerrormessage id='error_gallery'}    
            <div id="mediasharex_edit_img_info" >                         
            <span><i class="icon-camera icon-2x"></i>
            {if $__ATTRIBUTES__.gallery neq false} 
            {gt text='You have'} {$images_preview|@count } {gt text='images'}
            {else}
            {gt text='Here you can select up to 3 images'}
            {/if}
            </span>                
            </div>    
                                
            {if $__ATTRIBUTES__.gallery neq false}             
            {foreach from=$__ATTRIBUTES__.gallery key=k item=image name=imagess}
            <div id="mediasharex_edit_image_{$k}" class="mediasharex_edit_images">    
            
            {if $image.file_name}
            <a href="" class="tip" title="{$image.orig_name}"> 
            {thumb image="MContent_files/Mediasharex/`$image.file_name`" tag=true width=180 height=150 mode='inset' extension='png'}
            </a>
            <a href="#" id="mediasharex_edit_img_delete" class="z-hide">
            <i class="icon-remove-circle offline"></i> {gt text="Delete image"}</a>
            <input type="checkbox" name="delete[{$k}]" value="1">{gt text="Delete image"}
            
            {elseif $image.file_name eq false}
            <div style="text-align: center;padding:10px;">  
            <p><i class="icon-exclamation-sign offline"></i> {gt text="Unknow image"}</p>
            </div>
            <a href="#" id="mediasharex_edit_img_delete" ><i class="icon-remove-circle offline"></i> {gt text="Delete image"}</a>                                           
            <input type="checkbox" name="delete[{$k}]" value="1">  {gt text="Delete image"}
            {else}
            <div style="text-align: center;padding:10px;">  
            <p><i class="icon-exclamation-sign offline"></i> {gt text="Unknow image"}</p>
            </div>
            <a href="#" id="mediasharex_edit_img_delete" ><i class="icon-remove-circle offline"></i> {gt text="Delete image"}</a>                                           
            <input type="checkbox" name="delete[{$k}]" value="1"> {gt text="Delete image"}
            {/if}
            </div>
            {/foreach}
            {/if}            

            {if $__ATTRIBUTES__.gallery|@count lt 3}             
            <div id="mediasharex_edit_img_add" >
            <i class="icon-plus-sign icon-2x"></i> <input name="images[]" id="images" size="5" type="file" multiple="" accept="image/*" />   
            </div>
            <div id="progress" class="z-hide">
            <div class="bar" style="width: 0%;"></div>
            </div> 
            {elseif $__ATTRIBUTES__.gallery|@count gt 3}
            <div style="text-align: center;padding:10px;">  
            <p><i class="icon-exclamation-sign offline"></i> {gt text="Only 3 images allowed"}</p>
            </div>                           
            {/if}                              
    </div>
    {/if} 
    {if $access.edit} 
        <div id="mediasharex__edit_col3_options" class="MC780 z-formrow z-clearer">       
    <a href="#top" id="mediasharex_edit_options_add">           
    <h3>{gt text="Editor settings"} <i class="icon-cog"></i></h3>
    </a>
    

    
    <div id="mediasharex_edit_options_box" class="">
        
       
    <div id="mediasharex_edit_message_box" class="MC380 z-floatleft">
           <h4>{gt text="Group features"}</h4>     
        <div class="z-formrow">          
            {formlabel for="group_id" __text="Group" }
            {formtextinput id="group_id" size="60" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="forum_id" __text="Forum" }
            {formtextinput id="forum_id" size="60" maxLength="20"}
        </div>  
        <div class="z-formrow">          
            {formlabel for="gallery" __text="Gallery" }
            {formcheckbox id="showgallery" size="10" maxLength="100"}
        </div>      
        <div class="z-formrow">          
            {formlabel for="author" __text="Author" mandatory=true}
            {formtextinput id="author" size="10" maxLength="20"}
        </div>
         <div class="z-formrow">          
            {formlabel for="cr_uid" __text="Creator" mandatory=true}
            {formtextinput id="cr_uid" size="10" maxLength="20"}
        </div>  
    </div>
    
    <div id="mediasharex_edit_payment_box" class="MC380 z-floatright">
    <h4>{gt text="Unused"}</h4>     
        <div class="z-formrow">          
            {formlabel for="payment_opt" __text="Payment option" }
            {formtextinput id="payment_opt" size="1" maxLength="20"}
        </div>    
    
        <div class="z-formrow">          
            {formlabel for="payment_status" __text="Payment status" }
            {formtextinput id="payment_status" size="1" maxLength="20"}
        </div>
        <div class="z-formrow">          
            {formlabel for="payment_date" __text="Payment date" }
            {formtextinput id="payment_date" size="40" maxLength="20"}
        </div>    
    
        <div class="z-formrow">          
            {formlabel for="payment_reference" __text="Payment reference" }
            {formtextinput id="payment_reference" size="40" maxLength="20"}
        </div>         
           
    </div>         
       
    
<div class="MC780 z-clearer">                  
   <div id="mediasharex_edit_dates_col" class="MC380 z-floatleft"> 
       <h4>{gt text="Dates"}</h4>      
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
    <div id="mediasharex_edit_states_col" class="MC380 z-floatright">
        <h4>{gt text="Options"}</h4>      
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
        <div class="z-formrow">          
            {formcheckbox id="indepot" size="10" maxLength="100"}
             {formlabel for="indepot" __text="In depot" mandatory=true}
        </div>
   </div> 
   </div>         
   </div> 
      </div> 
     {/if} 
         
    <div id="mediasharex__edit_col4_buttons" class="MC580 mediasharex_edit_buttons">
       <div class="z-formrow">
        {formbutton class="mediasharex_edit_button_cancel button_2"  commandName="cancel"  __text="Cancel"}
        {formbutton class="mediasharex_edit_button_ok button_1"      commandName="save"  __text="Save"}             
       </div>
    </div>                        

{/form}
</div>
  {if $mediaitems|@count >0}
  <div id="mediasharex__edit_subalbums" class="z-clearfix z-clearer">
  <h3>{gt text="Media items"}</h3>  
  {foreach from=$mediaitems item=mediaitem}
  <div class="mediasharex__edit_subalbums z-floatleft">
  <span class="tip" title="{$mediaitem.title}">
  </span>
  <p class="tip" title="{$mediaitem.title}">
  {mediaitem data=$mediaitem}
  </p>
  </div>
  {/foreach}
  </div>
  {/if}  
  {if $subalbums|@count >0}
  <div id="mediasharex__edit_subalbums" class="z-clearfix z-clearer">
  <h3>{gt text="Subalbums"}</h3>  
  {foreach from=$subalbums item=subalbum}
  <div class="mediasharex__edit_subalbums z-floatleft">
      {album title=$subalbum.title}
  </div>
  {/foreach}
  </div>
  {/if}
</div>
{zdebug}
