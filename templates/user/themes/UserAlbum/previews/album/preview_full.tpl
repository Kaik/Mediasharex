   <div class="mediasharex_preview_album_full">
  <a href="{modurl modname=Mediasharex type=user func=display album=$subalbum.id}">     
  <div class="mediasharex-icon-folder-close" style="font-size:{$c_preview_data.height+40}px;">
   {modurl assign=url modname=Mediasharex type=user func=display album=$subalbum.id}
   {album data=$subalbum url=$url preview=$c_current_data}          
   <p>{$subalbum.title}</p>       
  </div>
  </a>      
  </div>