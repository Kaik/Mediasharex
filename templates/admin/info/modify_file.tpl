{adminheader}
{modulelinks links=$infolinks id='listid' class='z-menulinks' itemclass='z-ml-item' first='z-ml-first' last='z-ml-last'}

<div class="z-admin-content-pagetitle">
    {icon type="info" size="small"}
    <h3>{gt text="Modify file"}</h3>
</div>
        

<div id="mediasharex_info" class="z-clearfix">
    <div id="mediasharex_info_" class="z-clearfix">
   <form id="mediasharex_mainsettings_form" class="z-form" action="{modurl modname="mediasharex" type="admin" func="info_save_file"}" method="post" enctype="application/x-www-form-urlencoded">
            <div class="z-formbuttons z-buttons z-right">
                {button src='button_ok.png' set='icons/extrasmall' __alt='Save' __title='Save' __text='Save'}
            </div>
            <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />           
            <input type="hidden" name="file_path" value="{$file_path}" />
            <div class="z-formrow">
            <textarea name="file_content" style="width:100%;height:500px">{$file_content}</textarea>           
            </div>               

    </form>         
    </div>
</div>

{adminfooter}
