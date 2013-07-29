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
     <h1>{gt text="Modify media"}</h1>    
    {else}
     <h1>{gt text="Add media"}</h1>    
    {/if}
    
    
    
    
    
    
    <p id="top"></p>
    <div id="mediasharex_edit" class="z-clearfix">  

    <div class="MC380 z-floatleft">
    {foreach from=$sources item=source}        
            
    {if $isPostBack}

        {assign var="sname" value=$source.name}   
        {assign var="post_data" value=$sdata.$sname}     
        
        {if $post_data}           
        {source data=$post_data.pre_item preview='post' richMedia=true}
        {/if}
 

    
    {else}

        {source data=$source preview='add' richMedia=true}       
        
    {/if}
    
    {*foreachelse*}
    {/foreach}    
    </div>    

    <div class="MC380 z-floatleft">
    
       
    
    <div class="{if $isPostBack or $id > 0} {else} z-hide  {/if}">   
    <h3>{gt text="Title, description, category"}</h3>    
        <div class="mediasharex_edit_title z-formrow">
         {formlabel for="title" __text="Title" mandatorysym=true }
           <div class="input-appened">
            {formtextinput id="title" size="35" mandatory=true  maxLength="100"}
           <span class="add-on tip" title="{$title_holder}"><i class="icon-info-sign blue"></i></span>
           </div>
            {formerrormessage id='error_title'}    
        </div>              
        {*only edit access disable or z-hide*}       
        <div class="mediasharex_edit_urltitle z-formrow z-hide">
         {formlabel for="urltitle" __text="Short url"  mandatorysym=true }
            {formtextinput id="urltitle" size="35"  mandatory=true maxLength="100"}
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
            {formtextinput id="description" placeholder=$extendeddesc_holder text=$_item.description cssClass="noeditor" textMode="multiline" rows="5" cols="20"}
            {formerrormessage id='error_description'} 
        </div>                                                                                               
  </div>
  </div>
   












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










    <div id="mediasharex__" class="MC780 z-formrow z-clearer">
       <div class="z-buttons z-left">
        {formbutton class="z-w20"  commandName="cancel"  __text="Cancel"}
        
        {if $id > 0}
            {if $isPostBack eq true}                
            {formbutton class="z-hide z-w20" commandName="save"  __text="Save"}
            {formbutton class="z-w20" commandName="modify"  __text="Modify"}            
            {else}
            {formbutton class="z-hide z-w20" commandName="save"  __text="Save"}                    
            {formbutton class="z-w20" commandName="modify"  __text="Modify"}
            {/if}
        {else}              
            {if $isPostBack eq true}                
            {formbutton class="z-w20" commandName="save"  __text="Save"}        
            {formbutton class="z-w20 z-hide" commandName="check"  __text="Upload media item"}
            {else}
            {formbutton class="z-w20 z-hide" commandName="save"  __text="Save"}        
            {formbutton class="z-w20" commandName="check"  __text="Upload media item"}
            {/if} 
                    
        {/if}
       </div>
    </div> 
       
{/form}
</div>
</div>
{zdebug}
