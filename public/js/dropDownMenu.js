/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    // Hide all the submenu ul/li s
    $("#nav li ul").hide();

    // Hook up mouse over events
    $("#nav li").hover(
        function() {
            var sibling = $(this).find("a").next();
            sibling.show();
        },
        function() {
            var sibling = $(this).find("a").next();
            sibling.hide();
        }
        );
});