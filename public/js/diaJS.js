/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var count = 0;

$(document).ready(function(){
    toUpdateFlightData();
});

function toUpdateFlightData(){
    $("table#person").createScrollableTable({
        width: '950px',
        height: '400px'
    });
    
    $("button#airlinetimeBtn").click(displayflightsearchresult);
    
    $("div.green").click(ArrivalDataUpdate);
    $("div.red").click(DepartureDataUpdate);
       
    $("div.box1").mouseover(testColor).mouseout(testColor1);
    
}
function displayflightsearchresult(){
    var field_a = $("#airline").val(); 
    var field_b = $("#flight").val();  
    var data = { 'airline': field_a , 'flight': field_b};
    
    $.ajax({
        type: 'POST',
        data: data,
        //data: "airline="+field_a + "&flight="+field_b,
        url: '/DIAWebZend/public/departureflight/displaydepartureairlineflightnumberflight',
        success: function(data){
            $("div#displayairlineandtimeresult").html(data);
        }
    });
}

function testColor(){
    $(this).css("background", "#7C8EC8");
}

function testColor1(){
    $(this).css("background", "#CBE0E1");
}

function  ArrivalDataUpdate(){
    count = 0;
    $("#progressbar2").show();
    updatingArrivalData();
    startArrivalProgress();
    useArrivalAjax();   
}

function updatingArrivalData(){
    $("p.ajaxPart2").load("/DIAWebZend/public/index/arrivalupdatingajax");
}

function  DepartureDataUpdate(){
    count = 0;
    $("#progressbar1").show();
    updatingDepartureData();
    startDepartureProgress();
    useDepartureAjax();    
}

function updatingDepartureData(){
    $("p.ajaxPart1").load("/DIAWebZend/public/departureflight/departureupdatingajax");
}

function useDepartureAjax(){
    $.ajax({
        url: '/DIAWebZend/public/departureflight/populatedeparturetable',
        success: updatedDepartureData
    });
}

function updatedDepartureData(){
    $("p.ajaxPart1").load("/DIAWebZend/public/departureflight/departureupdatedajax");
    $("#progressbar1").hide(3000);
    //$("#arrivalUpdateTime").load("/DIAWebZend/public/index/arrivaltimeupdateajax");
    $("#departureUpdateTime").load("/DIAWebZend/public/departureflight/departuretimeupdateajax");
}

function useArrivalAjax(){
    $.ajax({
        url: '/DIAWebZend/public/index/populatearrivaltable',
        success: updatedArrivalData
    });
}

function updatedArrivalData(){
    $("p.ajaxPart2").load("/DIAWebZend/public/index/arrivalupdatedajax");
    $("#progressbar2").hide(3000);
    $("#arrivalUpdateTime").load("/DIAWebZend/public/index/arrivaltimeupdateajax");
    //$("#departureUpdateTime").load("/DIAWebZend/public/departureflight/departuretimeupdateajax");
}


function startDepartureProgress()
{
    if(count < 100)
    {
        count = count+1;
        setTimeout("startDepartureProgress()", 50);
    }

    $("#progressbar1").progressbar({
        value: count
    });
}

function startArrivalProgress()
{
    if(count < 100)
    {
        count = count+1;
        setTimeout("startArrivalProgress()", 50);
    }

    $("#progressbar2").progressbar({
        value: count
    });
}