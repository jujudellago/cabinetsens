/*!
 *  Syntax Highlighting based on 'Snippet' by SteamDev (http://steamdev.com/snippet)
 *  http://syntaxhighlight.in v1.0.0
 *  Date: Sunday Jan 1, 2012
 *  version for JQuery
 */
$(document).ready(function() {
    function a(b) {
        top.consoleRef = window.open("", "myconsole", "width=600,height=300,left=50,top=50,menubar=0,toolbar=0,location=0,status=0,scrollbars=1,resizable=1");
        top.consoleRef.document.writeln("<html><head><title>Snippet :: Code View :: " + location.href + '</title></head><body bgcolor=white onLoad="self.focus()"><pre>' + b + "</pre></body></html>");
        top.consoleRef.document.close()
    }
    $(".snippet-container").each(function(b) {
        $(this).find("a.snippet-text").click(function() {
            var d = $(this).parents(".snippet-wrap").find(".snippet-formatted");
            var c = $(this).parents(".snippet-wrap").find(".snippet-textonly");
            d.toggle();
            c.toggle();
            if (c.is(":visible")) {
                $(this).html("html")
            } else {
                $(this).html("text")
            }
            return false
        });
        $(this).find("a.snippet-window").click(function() {
            var c = $(this).parents(".snippet-wrap").find(".snippet-textonly").html();
            a(c);
            $(this).blur();
            return false
        })
    });
    $(".snippet-toggle").each(function(b) {
        $(this).click(function() {
            $(this).parents(".snippet-container").find(".snippet-wrap").toggle()
        })
    })
});