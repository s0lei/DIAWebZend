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
    
    $("button#flightnumberBtn").click(displayflightnumbersearchresult);
    $("button#cityBtn").click(displaycityresult);
    $("button#timeBtn").click(displaytimeresult);
    $("button#arrivaltimeBtn").click(displayarrivaltimeresult);
    $("button#arrivalcityBtn").click(displayarrivalcityresult);
    $("button#arrivalflightnumberBtn").click(displayarrivalflightnumbersearchresult);
    
    $("div.green").click(ArrivalDataUpdate);
    $("div.red").click(DepartureDataUpdate);
       
    $("div.box1").mouseover(testColor).mouseout(testColor1);
    
}

function displayarrivalflightnumbersearchresult(){
    var field_a = $("#arrivalairline").val(); 
    var field_b = $("#arrivalflightnumber").val();  
    var data = { 'arrivalairline': field_a , 'arrivalflightnumber': field_b};
    
    $.ajax({
        type: 'POST',
        data: data,
        //data: "airline="+field_a + "&flight="+field_b,
        url: '/DIAWebZend_Afternoon/public/index/displayarrivalflightnumberflight',
        success: function(data){
            $("div#displayairlineresult").html(data);
        }
    });
}

function displayarrivalcityresult(){
    var field_a = $("#arrivalairline").val(); 
    var field_b = $("#arrivalcity").val();  
    var data = { 'arrivalairline': field_a , 'arrivalcity': field_b};
    
    $.ajax({
        type: 'POST',
        data: data,
        //data: "airline="+field_a + "&flight="+field_b,
        url: '/DIAWebZend_Afternoon/public/index/displayarrivalcityflight',
        success: function(data){
            $("div#displayairlineresult").html(data);
        }
    });
}

function displayarrivaltimeresult(){
    var field_a = $("#airline").val(); 
    var field_b = $("#starthour").val();
    var field_c = $("#startampm").val();
    var field_d = $("#endhour").val();
    var field_e = $("#endampm").val();
    
    var data = { 'airline': field_a , 'starthour': field_b, 'startampm': field_c, 'endhour': field_d, 'endampm': field_e};
    
    $.ajax({
        type: 'POST',
        data: data,
        //data: "airline="+field_a + "&flight="+field_b,
        url: '/DIAWebZend_Afternoon/public/index/displayarrivaltimeflight',
        success: function(data){
            $("div#displayairlineresult").html(data);
        }
    });
}

function displaytimeresult(){
    var field_a = $("#airline").val(); 
    var field_b = $("#starthour").val();
    var field_c = $("#startampm").val();
    var field_d = $("#endhour").val();
    var field_e = $("#endampm").val();
    
    var data = { 'airline': field_a , 'starthour': field_b, 'startampm': field_c, 'endhour': field_d, 'endampm': field_e};
    
    $.ajax({
        type: 'POST',
        data: data,
        //data: "airline="+field_a + "&flight="+field_b,
        url: '/DIAWebZend_Afternoon/public/departureflight/displaydeparturetimeflight',
        success: function(data){
            $("div#displayairlineresult").html(data);
        }
    });
}

function displaycityresult(){
    var field_a = $("#airline").val(); 
    var field_b = $("#city").val();  
    var data = { 'airline': field_a , 'city': field_b};
    
    $.ajax({
        type: 'POST',
        data: data,
        //data: "airline="+field_a + "&flight="+field_b,
        url: '/DIAWebZend_Afternoon/public/departureflight/displaydepartureairlineandcityflight',
        success: function(data){
            $("div#displayairlineresult").html(data);
        }
    });
}

function displayflightnumbersearchresult(){
    var field_a = $("#airline").val(); 
    var field_b = $("#flight").val();  
    var data = { 'airline': field_a , 'flight': field_b};
    
    $.ajax({
        type: 'POST',
        data: data,
        //data: "airline="+field_a + "&flight="+field_b,
        url: '/DIAWebZend_Afternoon/public/departureflight/displaydepartureairlineflightnumberflight',
        success: function(data){
            $("div#displayairlineresult").html(data);
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
    $("p.ajaxPart2").load("/DIAWebZend_Afternoon/public/index/arrivalupdatingajax");
}

function  DepartureDataUpdate(){
    count = 0;
    $("#progressbar1").show();
    updatingDepartureData();
    startDepartureProgress();
    useDepartureAjax();    
}

function updatingDepartureData(){
    $("p.ajaxPart1").load("/DIAWebZend_Afternoon/public/departureflight/departureupdatingajax");
}

function useDepartureAjax(){
    $.ajax({
        cache: false,
        url: '/DIAWebZend_Afternoon/public/departureflight/populatedeparturetable',
        success: updatedDepartureData
    });
}

function updatedDepartureData(){
    $("p.ajaxPart1").load("/DIAWebZend_Afternoon/public/departureflight/departureupdatedajax");
    $("#progressbar1").hide(3000);
    //$("#arrivalUpdateTime").load("/DIAWebZend/public/index/arrivaltimeupdateajax");
    $("#departureUpdateTime").load("/DIAWebZend_Afternoon/public/departureflight/departuretimeupdateajax");
}

function useArrivalAjax(){
    $.ajax({
        cache: false,
        url: '/DIAWebZend_Afternoon/public/index/populatearrivaltable',
        success: updatedArrivalData
    });
}

function updatedArrivalData(){
    $("p.ajaxPart2").load("/DIAWebZend_Afternoon/public/index/arrivalupdatedajax");
    $("#progressbar2").hide(3000);
    $("#arrivalUpdateTime").load("/DIAWebZend_Afternoon/public/index/arrivaltimeupdateajax");
    //$("#departureUpdateTime").load("/DIAWebZend/public/departureflight/departuretimeupdateajax");
}


function startDepartureProgress()
{
    if(count < 100)
    {
        count = count+0.1;
        setTimeout("startDepartureProgress()", 153);
    }

    $("#progressbar1").progressbar({
        value: count
    });
}

function startArrivalProgress()
{
    if(count < 100)
    {
        count = count+ 0.1;
        setTimeout("startArrivalProgress()", 153);
    }

    $("#progressbar2").progressbar({
        value: count
    });
}