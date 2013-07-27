{gt text="Describe image here like author etc" assign=img_note_holder}
{gt text="This will be shown on mediasharex list" assign=shortdesc_holder}
{gt text="This will be shown on mediasharex full view" assign=extendeddesc_holder} 
{include file="user/header.tpl"}
<div id="mediasharex" class="z-clearfix">

{formerrormessage id='message'}
    
    
{form cssClass="z-form" enctype="multipart/form-data"}


<div id="mediasharex_ajax">     
    <h2>{gt text="Images"}</h2>



    <div class="z-formrow">  
        <div class="z-w30 z-floatleft z-formrow">
        <div class="">    
           {if $img.file_name}
            <div id="mediasharex_edit_img" > 
            <img class="mediasharex_itemimg" src="MContent_files/Mediasharex/{$img.file_name}" /> 
            </div>         
            {else}
            <div id="mediasharex_edit_img" >  
            <img class="mediasharex_itemimg" src="MContent_files/Mediasharex/mediasharexlogo.png" /> 
            </div>        
            {/if}
        </div>
        </div>
        
        <div class="z-w50 z-floatleft">
        <div class="mediasharex_edit_image z-formrow">
         {formlabel for="img" __text="Image" }
            {formuploadinput id="img"}
            {formerrormessage id='error_img'}    
        </div>
        <div class="mediasharex_edit_img_note z-formrow">
         {formlabel for="img_note" __text="Image text"}
            {formtextinput id="img_note" size="45" placeholder=$img_note_holder  maxLength="100"}
        </div>
        </div>
    </div>


            
    <div class="mediasharex_edit_buttons">
       <div class="z-formrow">
        <input class="mediasharex_edit_button_cancel button_2" onclick="jQuery('#dialog').dialog('close');" value="{gt text='Close'}" type="button" />
        {formbutton class="mediasharex_edit_button_ok button_1"      commandName="save"  __text="Save"}             
       </div>
    </div>  
    
</div>     

    
                          

{/form}
</div>