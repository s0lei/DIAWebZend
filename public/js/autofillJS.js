

$().ready(function() {   
    $("#airline").autocomplete("get_album_list.php", {
        width: 260,
        matchContains: true,
        selectFirst: false
    });
});


