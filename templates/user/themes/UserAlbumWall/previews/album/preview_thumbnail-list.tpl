  <div class="mediasharex_preview_album_thumbnail-list z-clearer z-clearfix">
  <div class="mediasharex_preview_album_thumbnail-list_image_box" style="height:{$c_preview_data.height}px;width:{$c_preview_data.width}px;" >          
      <div class="mediasharex_preview_album_thumbnail-list_image_icon mediasharex-icon-folder-close" style="font-size:{$c_preview_data.height+50}px;">   
      </div>
    
      <div class="mediasharex_preview_album_thumbnail-list_image"> 
       {modurl assign=url modname=Mediasharex type=user func=display album=$subalbum.id}
       {album data=$subalbum url=$url preview=$c_current_data}     
      </div> 
  </div>  
  
    <div class="mediasharex_preview_album_thumbnail-list_right" style="width: -moz-calc(100% - {$c_preview_data.width+20}px);width: -webkit-calc(100% - {$c_preview_data.width+20}px);width: calc(100% - {$c_preview_data.width+20}px);">
    <h3>{$subalbum.title}</h3>
    <p>{$subalbum.description}</p>
    <div class="mediasharex_preview_album_thumbnail-list_bottom_imfo">
         <span class="tip" title="{gt text='Published'}"><i class="icon-time"></i> {$item.publishdate|date_format:"%H:%m %d/%m/%y"}</span>   
        &nbsp;
        <span class="tip" title="{gt text='Views'}"><i class="icon-eye-open"></i> {nocache}{$subalbum.hitcount}{/nocache}</span>
        &nbsp;
        <span class="tip" title="{gt text='Comments'}"><i class="icon-comment"></i> {$subalbum}</span> 
    </div>                
    
         
    </div>     
  </div>
 