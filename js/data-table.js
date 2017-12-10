/* data table functions */

$(document).ready(function(){
    
    function checkForChecks(){
        var checkboxes = document.getElementsByClassName("row-check");
        var thechecked = 0;
        for(var x = 0; x < checkboxes.length; x++)
            if(checkboxes[x].checked == true)
                thechecked++;
        
        document.getElementById("delete-data").innerHTML =
            "<img src=\"icons/remove.svg\" />" +
            "delete (" + thechecked + ")";
        
        for(var x = 0; x < checkboxes.length; x++)
            if(checkboxes[x].checked == true)
                return true;
        
        return false;
    }
    
    $("input#select-all").change(function(){
        var status = this.checked;
        $("table#main-table tr td:nth-child(1) input").each(function(){
            this.checked = status;
        });
        
        if(checkForChecks() == true)
            $("#data-options").show();
        
        else $("#data-options").hide();
    });

    
    $("button#delete-data").click(function(){
        $("#modal-overlay").css("display", "flex");
        $("#info-box").hide();
        $("#confirm-box").show();
        $("#adding-section").hide();
    });
    
    $("input.row-check").change(function(){
        if(checkForChecks() == true)
            $("#data-options").show();
        
        else $("#data-options").hide();
    });
    
    $("button#select-cancel").click(function(){
        
        $("#data-options").hide();
        
        $("input#select-all").each(function(){
            this.checked = false;
        });
        
        $("table#main-table tr td:nth-child(1) input").each(function(){
            this.checked = false;
        });
    });
});