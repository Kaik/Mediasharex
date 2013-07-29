{adminheader}
<div class="z-admin-content-pagetitle">
     {icon type="import" size="small"}
    <h3>{gt text="Installation"}</h3>
</div>
<div id="mediasharex_install" class="z-clearfix">
    <div id="mediasharex_install_" class="z-clearfix">
      <div id="mediasharex_install_status" class="z-w40 z-formrow z-floatleft">      
       <ul>
        <li><h3>{gt text="Instalation status"}</h3></li>
        <li><p><strong>{gt text="Installed tables"}</strong></p></li>
        {foreach from=$installed_tables key=table item=status}
        <li>{$table} {if $status}{icon type="ok" size="extrasmall"}{else}{icon type="cancel" size="extrasmall"}{/if}</li> 
        {/foreach}
       <li><p><strong>{gt text="Installed handlers"}</strong></p></li> 
       <li>{gt text="Found media handlers"} <i>(33)</i></li>    
       <li>{gt text="Found media sources"} <i>(4)</i></li>
    {if $fileUploadsAllowed}
        <li><p>{icon type="ok" size="extrasmall"}<strong>{gt text="File upload allowed"}</strong></p></li>
    {else}   
       <li><p>{icon type="cancel" size="extrasmall"}<strong>{gt text="No file upload allowed"}</strong></p></li>   
    {/if}                        
    {if $previous_mediashare}          
       <li>{gt text="Found previous Mediashare instalations"}</li>
       <li>{gt text="Previous version"} {$previous_mediashare.version}</li>          
       <li>{gt text="Previous version tables"} </li>                  
    {else}   
       <li><p><strong>{gt text="No Mediashare installation found"}</strong></p></li>   
    {/if}   
       </ul>
     </div> 
         
     <div class="z-w60 z-floatright">
           <div class="mediashare_install_banner z-formrow">
           {thumb image="modules/Mediasharex/images/install_banner.jpg" tag=true width=580 height=380 mode='inset' extension='png'}                          
           </div>
           
        <div class="mediashare_install_settings z-formrow">
        <h3>{gt text="Instalation settings"}</h3>
        <form class="z-form" action="{modurl modname="Extensions" type="admin" func="initialise"}" method="post" enctype="application/x-www-form-urlencoded">
        <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />     
        <input type="hidden" name="id" value="{$id|safetext}" />                   
        {foreach from=$install_options key=optionname item=default}
        {if $optionname eq 'activate'}
        
        {else}
        <div class="z-formrow "> 
        <label>{$optionname}</label> <input type="text" class="" value="{$default}" size="40" name="install_options[{$optionname}]" />
        </div>         
        {/if}
        {/foreach}
        
        <input type="text" class="z-hide" value="2" size="40" name="step" />
        
        <div class="z-formbuttons z-buttons z-formrow">
       <input type="submit" value="{gt text='Save settings'}" name="submit"/>
        </div>
        </form>
             
         </div>   
                     
     </div>
            
     </div>   

</div>
{adminfooter}
