//Global variables
var i = 1, timeout, step, pos, input_fields, allowed_emails = ["gmail.com", "yahoo.com", "yahoo.in", "hotmail.com", "outlook.com"];


//On page load
$(document).ready(function () {
    if ($(".welcome section").hasClass("registration")){ $(".multi_step li:first-child").css("opacity","1"); }
    $(".fields li:first-child").fadeIn().show();
    $(".fields li:last-child").fadeIn().show();
});


//Form button click
$("form .btn").click(function(){
    event.preventDefault();
    $(".welcome section").hasClass("login") ? pos = $(".fields li").length : pos = $(".fields li").length-1; 
    for (i; i<pos; i++){
        if ($(".welcome section").hasClass("registration")){ step = $(".multi_step li:nth-child("+i+")"); }
        let field = $(".fields li:nth-child("+i+")");
        let empty = 0;
        if ($(".welcome section").hasClass("registration") && $(this).html().toLowerCase() == "clear"){
            $(".fields li:nth-child("+i+") input").each(function () {
                $(this).val("");
            });
            return 1;
        }
        $(".fields li:nth-child("+i+") input").each(function () {
            if($(this).val() == "" ){
                $(this).css("border","1px solid red");
                $(this).prev("label").css("color","red");
                popup('warning','All fields are mandatory');
                empty++;
                return 1;
            }
        });
        if ($(".welcome section").hasClass("registration") && step.css("opacity") == 1 && empty == 0){
           step.html('<iconify-icon icon="simple-line-icons:check"></iconify-icon>').fadeIn();
           if (i == 2){
                if (allowed_emails.includes($("input[type='email']").val().toLowerCase().split('@').pop())){
                    $(".fields .btn_4").hide(); 
                    $(".fields li .btn_1").html("REGISTER");
                    $('.fields li .btn_1').attr('onclick', "ajax('registration')");
                    $(".fields li:last-child fieldset").css("justify-content","right");
                } else {
                    popup('warning', 'We allow providers from gmail, yahoo, outlook, hotmail');
                    return 1;
                }
           }
           field.hide();
           step.next().css("opacity","1");
           field.next().fadeIn().show();
           i++;
        }
        return 1;
    }
});


//On input
$("form input").on("input", function(){
    if ($(this).val() != "" && $(this).css("border") == "1px solid rgb(255, 0, 0)"){
        $(this).css("border", "1px solid var(--gray)");
        $(this).prev().css("color", "var(--gray)");
    }
});


//Preview Identity
$(".fields input[name='identity']").change(function(){
    $(this).prev().html('<img src="'+window.URL.createObjectURL(this.files[0])+'" alt="Identity" title="Identity" loading="lazy" />');
});


//Close
function closer(type, no){
    switch (type){
        case 1:
            clearTimeout(timeout);
            $(".alert").remove();
        break;
        case 2:
            $(".message").remove();
        break;
    }
}


//PopUp
function popup(type, mssg){
    let popups = $(".alert section").length;
    let alert = '<div class="alert"><section class="fixed_flex"><a href="javascript:void(0)" class="closer" onclick="closer(1, \'\')"><i class="fa fa-times"></i></a><iconify-icon icon="octicon:alert-16" class="'+type+'"></iconify-icon><article><h4 class="title small">'+type.charAt(0).toUpperCase()+type.slice(1)+'</h4><p>'+mssg+'</p></article></section></div>'; 
    if (!popups > 0) {
        $("body").append(alert);
        timeout = setTimeout(function() {$(".alert").remove(); clearTimeout(timeout);} ,5000);
    }
}

