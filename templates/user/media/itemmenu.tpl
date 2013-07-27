{if ($access.edit eq 1) or ($access.delete eq 1) or ($item.isowner eq 1) }
<ul class="mediasharex_itemmenu">	
    <li><a class="edit_link"  title="{gt text='Edit'}" href="{modurl modname='Mediasharex' type='user' func='modify' id=$item.id}"><i class="icon-pencil"></i> {gt text='Edit'}</a>
    {if ($access.edit eq 1) or ($access.delete eq 1)}   
	   <ul>
	   <li><a class="edit_link"  title="{gt text='Edit'}" href="{modurl modname='Mediasharex' type='user' func='modify' id=$item.id}"><i class="icon-pencil"></i> {gt text='Edit'}</a></li>
       <li><a class="edit_link"  title="{gt text='Edit'}" href="{modurl modname='Mediasharex' type='user' func='modify' id=$item.id}"><i class="icon-pencil"></i> {gt text='Edit'}</a></li>

        </ul>
    {/if}
    </li>

</ul>
{/if}


