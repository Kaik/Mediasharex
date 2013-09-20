{include file="user/header.tpl"}
{include file="user/menu.tpl"}
{* some texts *}
{gt  assign=title_holder text="You can add title here"}

<div id="mediasharex" class="z-clearfix">
     <h1>{gt text="Add media"}</h1>    
{formerrormessage id='message'}      
{form cssClass="z-form" enctype="multipart/form-data"}
{formvolatile}
    <p id="top"> </p>
    <div id="mediasharex_add_media" class="z-clearfix">
        
        {if $isPostBack}       
        <div class=""> 
            {* load media previews  *}    
            {foreach from=$media key=key item=mediaitem}                        
            <div class="z-w30 z-floatleft">   
                {*mediaitem data=$mediaitem  width=200  height=200  id="media-`$key`" richmedia=true class='add_media'*}
            <div id="mediasharex_admin_manager_modify_media_title" class="z-formrow">


            {formtextinput text=$parentalbum                id="m`$key`parentalbum"    dataBased=true dataField="parentalbum"      group="m`$key`"  textMode="hidden" }
            {formtextinput text=$mediaitem.title            id="m`$key`title"          dataBased=true dataField="title"            group="m`$key`"  size="35" maxLength="100"}
            {formtextinput text=$mediaitem.description      id="m`$key`description"    dataBased=true dataField="description"      group="m`$key`"  size="35" maxLength="100"}           

            {formtextinput text=$mediaitem.handler      id="m`$key`handler"     dataBased=true dataField="handler"   group="m`$key`"  textMode="hidden" }
            {formtextinput text=$mediaitem.mimetype     id="m`$key`mimetype"    dataBased=true dataField="mimetype"  group="m`$key`"  textMode="hidden" }
            {formtextinput text=$mediaitem.fileref      id="m`$key`fileref"     dataBased=true dataField="fileref"   group="m`$key`"  textMode="hidden" }
            {formtextinput text=$mediaitem.bytes        id="m`$key`bytes"       dataBased=true dataField="bytes"     group="m`$key`"  textMode="hidden" }
            {formtextinput text=$mediaitem.preview      id="m`$key`preview"     dataBased=true dataField="preview"   group="m`$key`"  textMode="hidden" }


            </div>
            </div>    
            {*foreachelse*}
            {/foreach}    
        </div>               
        {else}
        <div class=""> 
            {* load sources  *}    
            {foreach from=$sources item=source}                  
                {source data=$source preview='add' richMedia=true}       
            {*foreachelse*}
            {/foreach}    
        </div> 
        {/if}
    
    <div id="mediasharex__" class="z-formrow z-clearer">
       <div class="z-buttons">
        {formbutton class="z-w20"  commandName="cancel"  __text="Cancel"}
        {if $isPostBack eq 1}
        <span class="z-floatright"> {formbutton class="z-w20" commandName="save"  __text="Save"} </span>
        {else}
        <span class="z-floatright"> {formbutton class="z-w20" commandName="check"  __text="Add"} </span>
        {/if}                   
       </div>
    </div>            
    </div>
{/formvolatile}           
{/form}
</div>
{zdebug}
