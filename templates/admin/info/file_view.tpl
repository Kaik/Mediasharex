{adminheader}
{$modulelinks links=$infolinks id='infolinks' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'*}

<div class="z-admin-content-pagetitle">
    {icon type="info" size="small"}
    <h3>{gt text="Docs"} {$file_path}</h3>
</div>
   <form id="mediasharex_mainsettings_form" class="z-form" action="{modurl modname="mediasharex" type="admin" func="info_modify_file"}" method="post" enctype="application/x-www-form-urlencoded">

            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           
            <input type="hidden" name="file_path" value="{$file_path}" /> 
            <div class="z-formbuttons z-buttons z-right">
                {button src='button_ok.png' set='icons/extrasmall' __alt='Edit' __title='Edit' __text='Edit'}
            </div>
    </form>        
<div id="mediasharex_info" class="z-clearfix">
    <div id="mediasharex_info_" class="z-clearfix">
        <div class="z-formrow z-w75 z-floatright">
        {$file_content}            
         </div>
         <div class="z-formrow z-w25 z-floatleft">
         <ul>   
         {foreach from=$docslinks item=langs}
         <li>{$langs.text}
             <ul>   
             {foreach from=$langs.links item=dirtypes}
             <li>{$dirtypes.text}
                 <ul>   
                 {foreach from=$dirtypes.links item=files}
                 <li><a href="{$files.url}" >{$files.text}</a></li>         
                 {/foreach}
                 </ul>            
            </li>         
             {/foreach}
             </ul>            
      
        </li>         
         {/foreach}
         </ul>            
         </div>            
    </div>
</div>
{adminfooter}

{*zdebug*}
