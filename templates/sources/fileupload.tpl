<div class="mediasharex_source_anyfileupload z-formrow">
  <h3><i class="icon-cloud-upload"> </i> {gt text="Upload file from your disk drive"}</h3>
  <label>{gt text="Select file from disk"}</label>
  <div class="input-appened">
       {$sourcedata.plugin}
       <span class="add-on tip" title="{$sourcedata.fieldtip}"><i class="icon-info-sign"> </i></span>
  </div>   
</div>
        
        
{*formerrormessage id='error_titlexx'*}                       
{*$sourcedata|@print_r*}