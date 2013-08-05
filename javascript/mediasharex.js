Zikula.define('Mediasharex');

document.observe("dom:loaded", function()
{

Zikula.Mediasharex.Base.Init();  
			
});

Zikula.Mediasharex.Base = 
{
    Init: function()
    {
      jQuery(".tip").tooltip();
    }
};        