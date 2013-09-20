  <div class="z-w33 z-floatleft mediasharex_preview_media_thumbnail"> 
        {modurl assign=url modname=Mediasharex type=user func=display album=$mediaitem.parentalbum media=$mediaitem.id}
        {mediaitem data=$mediaitem url=$url preview=$c_preview_data richmedia=true}
    <div class="mediasharex_preview_media_thumbnail_info">    
        <span class="tip" title="{gt text='Category'}"><i class="mediasharex-icon-sitemap"></i> <a href="{modurl modname='Mediasharex' type='user' func='view' category=$mediaitem.__CATEGORIES__.Cat.name}">&nbsp;{$mediaitem.__CATEGORIES__.Cat.display_name.$lang}&nbsp;</a></span>
        <span class="tip" title="{gt text='Author'}"><i class="mediasharex-icon-user"></i> {$mediaitem.author}</span>
        <span class="tip" title="{gt text='Views'}"><i class="mediasharex-icon-eye-open"></i> {nocache}{$mediaitem.hitcount}{/nocache}</span>      
    </div>               
    <p class="mediasharex_preview_media_thumbnail_title">{$mediaitem.title}</p> 
  </div>
  
