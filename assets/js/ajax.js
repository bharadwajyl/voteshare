//Global variables
var serialize, url, call_ajax = false, content;


//Form Submit
function ajax(type){
    switch (type){
        case "registration":
            $('.fields li .btn_1').attr('onclick', "");
            serialize = new FormData($(".registration form")[0]);
            serialize.append('FormType', type);
            $.ajax({ type: "POST", url: "root/", data: serialize, cache: false, contentType: false, processData: false,
                success: function(output){
                    if (output.match(/error:/g)) {
                        popup("danger", output.replace(/error:/g, ""));
                        $('.fields li .btn_1').attr('onclick', "ajax('registration')");
                    } else {
                        $("."+type+" form").remove();
                        output.match(/success:/g) ?
                        $("."+type).append(output.replace(/success:/g, " ")) :
                        $("."+type).append(output.replace(/failure:/g, " "));
                    }
                }
            });
        break;
        case "login":
            serialize = $("."+type+" form").serialize()+"&FormType="+type;
            url = "root/";
            call_ajax = true;
        break;
        case "logout":
            serialize = "FormType="+type;
            url = "root/";
            call_ajax = true;
        break;
    }
    
    if (call_ajax == true){
        $.ajax({ type: "POST", url: url, data: serialize,
            success: function(output){
                output.match(/success:/g) ? 
                location.reload():
                popup("danger", output.replace(/failure:/g, ""));
            }
        });
    }
}
