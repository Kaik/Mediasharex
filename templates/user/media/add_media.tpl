{include file="user/header.tpl"}

{* some texts *}
{gt  assign=title_holder text="You can add title here"}

<div id="mediasharex" class="z-clearfix">
{formerrormessage id='message'}      
{form cssClass="z-form" enctype="multipart/form-data"}

     <h1>{gt text="Add media"}</h1>    
 
    <p id="top"> </p>
    <div id="mediasharex_add_media" class="z-clearfix">
 

    {* load preview  *} 
    
    
    
<div class="{if $isPostBack }{else}z-hide{/if} z-clearer z-clearfix">
    
<div class="z-w40 z-floatleft">   
{mediaitem data=$post_data.pre_media  width=280  height=280  id="media-`$new_items.0.id`" richmedia=true class='big'}      
</div>

<div class="z-w60 z-floatright">         
    <h3><i class="mediasharex-icon-edit"> </i> {gt text="Media details"}</h3>
        <div id="mediasharex_admin_manager_modify_media_title" class="z-formrow">
         {formlabel for="title" __text="Title" }
           <div class="input-appened">
            {formtextinput id="title" size="35" maxLength="100"}
           <span class="add-on tip" title="{$title_holder}"><i class="mediasharex-icon-info-sign"> </i></span>
           </div>
            {formerrormessage id='error_title'}    
        </div>              

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
        <div class="input-appened">
                 {formdropdownlist id='accesslevel' items=$access_select}
                 <span class="add-on tip" title="{$cat_holder}"><i class="mediasharex-icon-info-sign"></i></span>
                 </div>             
                 
        </div>                           
        <div id="mediasharex_admin_manager_modify_media_description" class="z-formrow">
            {formlabel for="description" __text="Description" }
            {formtextinput id="description" placeholder=$extendeddesc_holder cssClass="noeditor" textMode="multiline" rows="5" cols="75"}
            {formerrormessage id='error_description'} 
        </div> 
</div>

{formtextinput textMode="hidden" id="previewname"}
{formtextinput textMode="hidden" id="fileref"}
{formtextinput textMode="hidden" id="mediaitem"}
{formtextinput textMode="hidden" id="mimetype"}
{formtextinput textMode="hidden" id="width"}
{formtextinput textMode="hidden" id="height"}
{formtextinput textMode="hidden" id="bytes"}

{formtextinput textMode="hidden" id="parentalbum"}
{formtextinput textMode="hidden" id="position"}
{formtextinput textMode="hidden" id="handler"}

</div>




<div class="{if $isPostBack}z-hide{else}{/if}"> 
    {* load sources  *}    
    {foreach from=$sources item=source}                  
        {source data=$source preview='add' richMedia=true}       
    {*foreachelse*}
    {/foreach}    
</div> 
 
        

    
    
    <div id="mediasharex__" class="z-formrow z-clearer">
       <div class="z-buttons">
        {formbutton class="z-w20"  commandName="cancel"  __text="Cancel"}


        <span class="z-floatright {if $isPostBack}{else}z-hide{/if}"> {formbutton class="z-w20" commandName="save"  __text="Save"} </span> 


        <span class="z-floatright {if $isPostBack}z-hide{else}{/if}"> {formbutton class="z-w20" commandName="check"  __text="Add"} </span>       
            
       </div>
    </div>      
    
    
    
</div>       
{/form}
</div>
{*zdebug*}
