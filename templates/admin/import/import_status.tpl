{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="filter" size="small"}
    <h3>{gt text="Import status"}</h3>
</div>

{if $imported|@count >1}
<div class="z-statusmsg z-clearer">
<h3>{gt text="Imported :)"}</h3>
<p>{gt text="Sucessfully imported"} {$imported|@count} {gt text="rows"}</p>
</div>    

{else}
<div class="z-errormsg z-clearer">
<h3>{gt text="Import failed"}</h3>
</div> 

{/if}
{adminfooter}
