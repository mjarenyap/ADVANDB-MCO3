/* sidebar navigation functions */

$(document).ready(function(){
    $("nav ul li").click(function(){
        $("nav ul li").removeClass("active");
        $(this).addClass("active");
    });
});