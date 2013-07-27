{gt text="Describe image here like author etc" assign=img_note_holder}
{gt text="This will be shown on mediasharex list" assign=shortdesc_holder}
{gt text="This will be shown on mediasharex full view" assign=extendeddesc_holder} 
{include file="user/header.tpl"}
<div id="mediasharex" class="z-clearfix">

{formerrormessage id='message'}
    
    
{form cssClass="z-form" enctype="multipart/form-data"}


<div id="mediasharex_ajax">       
    <div class="z-formrow">  
        <div class="z-w60 z-floatleft mediasharex_edit_topic z-formrow">
        <div class="mediasharex_edit_title z-formrow">
         {formlabel for="title" __text="Title" mandatorysym=true }
            {formtextinput id="title" size="45" mandatory=true maxLength="100"}
            {formerrormessage id='error_title'}    
        </div>
        <div class="mediasharex_edit_urltitle z-formrow">
         {formlabel for="urltitle" __text="Short url" mandatorysym=true }
            {formtextinput id="urltitle" size="45" mandatory=true maxLength="100"}
            {formerrormessage id='error_urltitle'}    
        </div>
        </div>  
   
            
    <div class="z-w35 z-floatright mediasharex_edit_buttons">
       <div class="z-formrow">
        <input class="mediasharex_edit_button_cancel button_2" onclick="jQuery('#dialog').dialog('close');" value="{gt text='Close'}" type="button" />
        {formbutton class="mediasharex_edit_button_ok button_1"      commandName="save"  __text="Save"}             
       </div>
    </div>  
    
    </div>     


                          

{/form}
</div>