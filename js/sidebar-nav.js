/* sidebar navigation functions */

$(document).ready(function(){
    var region = getParameterByName("region");
    if (region != null) {
        $("nav ul li:contains(" + region +")").addClass("active");
    }

    $("nav ul li").click(function(){
        $("nav ul li").removeClass("active");
        $(this).addClass("active");
        // location.reload();
        console.log("?region=" + encodeURIComponent($(this).text()));
        window.location.replace("?region=" + encodeURIComponent($(this).text()));
        // $.ajax({
        //     url: "index.php?region=" + $(this).text(),
        //     type: "get",
        //     success: function(result) {
        //         location.reload();
        //         // console.log("wat");
        //     }
        // })
    });

});

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) 
        return null;
    if (!results[2]) 
        return '';
    
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}