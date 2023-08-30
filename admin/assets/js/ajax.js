//New user requests
function ajax(type, no){
    switch (type){
        case "verify": case "terminate": case "verified":
            serialize = "&FormType="+type+"&code="+no;
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
                if (output.match(/modal:/g)){
                    $("body").append('<div class="overlay" onclick="closer(\'overlay\',\'\')"></div>');
                    $("body").append(output.replace(/modal:/g, ""));
                } else if (output.match(/success:/g)){
                    location.reload();
                } else { 
                    popup("danger", output.replace(/failure:/g, ""));
                }
            }
        });
    }
}
