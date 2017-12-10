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


    $("#confirm-box .confirm").click(function(){
        var checkboxes = document.getElementsByClassName("row-check");
        var thechecked = 0;
        var toBeDeleted = [];

        for(var x = 0; x < checkboxes.length; x++)
            if(checkboxes[x].checked == true) {
                toBeDeleted.push(checkboxes[x].getAttribute("data-id"));
                thechecked++;
            }

        $("#form-type").val("delete");
        
        console.log(JSON.stringify(toBeDeleted));

        $.ajax({
            data: {data: JSON.stringify(toBeDeleted), 
                   type: $("#form-type").val()},
            url: 'service/submit.php',
            method: 'POST',
            success: function(result) {
                // document.write(result);
                location.reload();
            }
        });

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

        //display appropriate data
        var countryCode = this.innerHTML;
        var seriesCode = this.nextSibling.innerHTML;
        var year = this.nextSibling.nextSibling.innerHTML;
        var data = this.nextSibling.nextSibling.nextSibling.innerHTML;
        var id = this.previousSibling.firstElementChild.getAttribute("data-id");
        console.log(id);

        document.getElementById("info-countryCode").innerHTML = countryCode;
        document.getElementById("info-seriesCode").innerHTML = seriesCode;
        document.getElementById("info-year").innerHTML = year;
        document.getElementById("info-data").innerHTML = data;
        document.getElementById("info-id").value = id;
    });

    $("#info-box .form-trigger").click(function(){
        $("#modal-overlay").css("display", "flex");
        $("#confirm-box").hide();
        $("#info-box").hide();
        $("#adding-section").show();

        document.getElementById("form-heading").innerHTML = "Edit the data";
        $("#form-type").val("update");

        var countryCode = document.getElementById("info-countryCode").innerHTML;
        var seriesCode = document.getElementById("info-seriesCode").innerHTML;
        var year = document.getElementById("info-year").innerHTML;
        var data = document.getElementById("info-data").innerHTML;
        var id = document.getElementById("info-id").value;

        document.getElementById("form-country").value = countryCode;
        document.getElementById("form-series").value = seriesCode;
        document.getElementById("form-year").value = year;
        document.getElementById("form-data").value = data;
        document.getElementById("form-id").value = id;

    });
    
    $("header .form-trigger").click(function(){
        $("#modal-overlay").css("display", "flex");
        $("#confirm-box").hide();
        $("#info-box").hide();
        $("#adding-section").show();

        document.getElementById("form-heading").innerHTML = "Add a new data";
        $("#form-type").val("insert");

        // var countryCode = document.getElementById("form-country").value;
        // var seriesCode = document.getElementById("form-series").value;
        // var year = document.getElementById("form-year").value;
        // var data = document.getElementById("form-data").value;

        // $.ajax({
        //     data: {countryCode: countryCode,
        //            seriesCode: seriesCode,
        //            year: year,
        //            data: data, 
        //            type: $("#form-type").val()},
        //     url: 'service/submit.php',
        //     method: 'POST',
        //     success: function(result) {
        //         // document.write(result);
        //         location.reload();
        //     }
        // });
    });

    // $("#add-form #data-submit").on('keyup keypress', function(e) {
    //     var keyCode = e.keyCode || e.which;
    //     if (keyCode === 13) { 
    //         e.preventDefault();
    //         return false;
    //     }
    // });

    // $("#add-form #data-submit").submit(function() {
    //     console.log("ugh");
    //     return false;
    // });

    $("#add-form #data-submit").click(function() {
        var countryCode = document.getElementById("form-country").value;
        var seriesCode = document.getElementById("form-series").value;
        var year = document.getElementById("form-year").value;
        var data = document.getElementById("form-data").value;
        var id = document.getElementById("form-id").value;

        $.ajax({
            data: {country: countryCode,
                   series: seriesCode,
                   year: year,
                   data: data,
                   id: id,
                   type: $("#form-type").val()},
            url: 'service/submit.php',
            method: 'POST',
            success: function(result) {
                // document.write(result);
                location.reload();
            }
        });
    });
});