/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var geocoder;
var map;
var htmlLocation;
var htmlJqueryLocation;
var query;
var trMap;

$(document).ready(function(){

    $(".mapHideBtn").attr("disabled", true);
    $(".mapRow").addClass("hideRow");
});

//function showMap(mapAddress, locationID){
function showMap(city, locationID){ 
    query = city;
    htmlLocation = locationID;
    trMap = "#" + locationID + "D";
    htmlJqueryLocation = "#" + locationID;
    $(htmlJqueryLocation).show();
    $(htmlJqueryLocation).addClass("mapSpace");
    //$(".mapRow").removeClass("hideRow");
    $(trMap).removeClass("hideRow");
    initialize();
    $(".mapShowBtn").attr("disabled", true);
    $(".mapHideBtn").attr("disabled", false);
}

function hideMap(){

    //$(htmlJqueryLocation).hide();
    $(htmlJqueryLocation).removeClass("mapSpace");
    //$(".mapRow").addClass("hideRow");
    $(trMap).addClass("hideRow");
    $(".mapShowBtn").attr("disabled", false);
    $(".mapHideBtn").attr("disabled", true);
}

function initialize() {
    geocoder = new google.maps.Geocoder();
    var myOptions = {
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById(htmlLocation), myOptions);
    codeAddress();
}

function codeAddress() {
    var address = query;
    geocoder.geocode( {
        'address': address
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}