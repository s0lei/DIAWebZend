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
    $("div.green").click(ArrivalDataUpdate);
    $("div.red").click(DepartureDataUpdate);
    
    $("div.box1").mouseover(testColor).mouseout(testColor1);
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
    $("p.ajaxPart1").load("/DIAWebZend/public/departureUpdatingAjax.jsp");
}

function useDepartureAjax(){
    $.ajax({
        url: '/DIAWeb/DepartureFlightUpdatedAjax',
        success: updatedDepartureData
    });
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
}

function updatedDepartureData(){
    $("p.ajaxPart1").load("/DIAWeb/departureUpdatedAjax.jsp");
    $("#progressbar1").hide(3000);
    $("#departureUpdateTime").load("/DIAWeb/updateDepartureTimeAjax.jsp");
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