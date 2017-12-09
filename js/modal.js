/* modal functions javascript */

$(document).ready(function(){
    var closeButton = document.getElementsByClassName("close")[0];
    
    $(closeButton).click(function(){
        $("#modal-overlay").hide();
    });
    
     $("#discard").click(function(){
        $("#modal-overlay").hide();
    });
    
    $(".cancel").click(function(){
        $("#modal-overlay").hide();
        
        $("#data-options").hide();
        
        $("input#select-all").each(function(){
            this.checked = false;
        });
        
        $("table#main-table tr td:nth-child(1) input").each(function(){
            this.checked = false;
        });
    });
    
    $("table.data-table tr td:nth-child(2)").click(function(){
        $("#modal-overlay").css("display", "flex");
        $("#confirm-box").hide();
        $("#info-box").show();
        $("#adding-section").hide();
    });
    
    $(".form-trigger").click(function(){
        $("#modal-overlay").css("display", "flex");
        $("#confirm-box").hide();
        $("#info-box").hide();
        $("#adding-section").show();
    });
});