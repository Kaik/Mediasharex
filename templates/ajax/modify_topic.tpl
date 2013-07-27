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
         {formlabel for="Topic" __text="Topic" mandatorysym=true }
             {formcategoryselector category=$catreg.Topic id="Topic" mandatory=true selectedValue=$__CATEGORIES__.Topic.id defaultValue="0" enableDBUtil=1}
             {formerrormessage id='error_topic'}
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