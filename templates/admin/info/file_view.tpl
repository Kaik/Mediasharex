{include file="admin/admin_header.tpl"}
{adminheader}
{$modulelinks links=$infolinks id='infolinks' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'*}

<div class="z-admin-content-pagetitle">
    <h3><i class="mediasharex-icon-cabinet"></i> {gt text="Documentation"}</h3>
    <div><i class="mediasharex-icon-tree"></i> {$file_path} </div>
</div>
<div id="mediasharex_admin_info_docs" class="z-clearfix">


   <form id="mediasharex_admin_info_docs_form" class="z-form" action="{modurl modname="mediasharex" type="admin" func="info_modify_file"}" method="post" enctype="application/x-www-form-urlencoded">

            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           
            <input type="hidden" name="file_path" value="{$file_path}" /> 
            <div class="z-formbuttons z-buttons z-right">
                {button src='edit.png' set='icons/extrasmall' __alt='Edit' __title='Edit' __text='Edit'}
            </div>
    </form>        
<div id="mediasharex_admin_info_docs_content" class="z-clearfix">
        <div id="mediasharex_admin_info_docs_file_content" class="z-formrow z-w75 z-floatright">
        {$file_content}            
         </div>       
         <div id="mediasharex_admin_info_docs_directory_tree" class="z-formrow z-w25 z-floatleft">
         <ul>   
         {foreach from=$docslinks item=langs}
         <li><i class="{$langs.class}"></i> {$langs.text}
             <ul>   
             {foreach from=$langs.links item=dirtypes}
             <li><i class="{$dirtypes.class}"></i> {$dirtypes.text}
                 <ul>   
                 {foreach from=$dirtypes.links item=files}
                 <li>{if $files.text eq $file_name}<i class="mediasharex-icon-eye"></i> {/if}  <i class="{$files.class}"></i> <a href="{$files.url}" >{$files.text}</a></li>         
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
