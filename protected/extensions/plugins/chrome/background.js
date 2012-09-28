var maxNotation = 10;
var urlAjax;
var menuTop = chrome.contextMenus.create({title: 'Noter "%s" sur styledWords', contexts:["selection"]});
for(var i=1; i<=maxNotation; i++)
{
    chrome.contextMenus.create({id: "note:"+i, title: ""+i+" / "+maxNotation, contexts:["selection"], parentId: menuTop, onclick: function(info, tab)
    {
        var splitId = info.menuItemId.split(':');
        var id = splitId[1];
        alert("rate "+info.selectionText+" with "+id);
        $.ajax({
            type: "POST",
            url: "some.php",
            data: { name: "John", location: "Boston" }
        }).done(function( msg ) {
                alert( "Data Saved: " + msg );
            });
    }
    });
}
