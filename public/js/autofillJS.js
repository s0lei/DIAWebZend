
$().ready(function() {
    $("#airline00").autocomplete("get_airline_list.php", {
        width: 260,
        matchContains: true,
        selectFirst: false
    });
    
    $("#flight").autocomplete("get_flightnumber_list.php", {
        width: 260,
        matchContains: true,
        selectFirst: false
    });
    
    $("#city").autocomplete("get_city_list.php", {
        width: 260,
        matchContains: true,
        selectFirst: false
    });
});


