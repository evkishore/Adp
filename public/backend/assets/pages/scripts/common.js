$(function(){

    var settings = {
                    theme: "teal",// "teal" | "amethyst" | "ruby" | "tangerine" | "lemon" | "lime" | "ebony" | "smoke"
                    sticky: false, // true | false
                    horizontalEdge: "top", // "bottom" | "top"
                    verticalEdge: "right" // "right" | "left"
                };
   /* if ($.trim($('#notific8_heading').val()) != '') {
        settings.heading = $.trim("Heading Notification!");
    }*/

    if (!settings.sticky) {
        settings.life = 10000;// Defaule 10s
    }
    $.notific8('zindex', 11500);
    $.each($("#divMessage [class$=Message]"), function(){
        var _className = $(this).attr("class").replace(/Message/,"");
        switch(_className){
            case "success":
                settings.theme = "teal";
                settings.heading = "Success";
            break;

            case "error":
                settings.theme = "ruby";
                settings.heading = "Error";
            break;

            case "notice":
                settings.theme = "tangerine";
                settings.heading = "Notice";
            break;

            case "warning":
                settings.theme = "lemon";
                settings.heading = "Warning";
            break;
        }
        var _message = $.trim($(this).text());
        if(_message != "")
            $.notific8($.trim(_message), settings);
        $(this).remove();
    });


    $("div.tools a.reload").click(function(){
       $('form').submit();
        return true;
    });

     $("#div-paging ul>li> a").click(function() {
            if ($(this).closest("li").hasClass("disabled")) {
                return false;
            }
            var _page = $(this).data("pageindex");
            $("#page").val(_page);
            $("#page_size").val($("#select-page_size option:selected").val());
            $(".form-actions button[type='submit']").click();
        });
        $("#select-page_size").change(function() {
            var _page = $("#div-paging ul>li.active> a").data("pageindex") * 1;
            $("#page").val(1);
            $("#page_size").val($(this).val());
            $(".form-actions button[type='submit']").click();
        });

});
