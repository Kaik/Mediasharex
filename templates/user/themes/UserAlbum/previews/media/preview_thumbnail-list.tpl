<div class="mediasharex_preview_media_thumbnail-list"> 
<div class="mediasharex_preview_media_thumbnail-list_image" style="height:{$c_preview_data.height}px;width:{$c_preview_data.width}px"> 
    {modurl assign=url modname=Mediasharex type=user func=display album=$mediaitem.parentalbum media=$mediaitem.id}
    {mediaitem data=$mediaitem url=$url preview=$c_preview_data}
</div>
<div class="mediasharex_preview_media_thumbnail-list_right">
<p>{$mediaitem.title}</p>    
</div>
</div>
  
