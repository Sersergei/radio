/**
 * Created by Сергей on 11.12.2015.
 */
$(document).ready(function() {
    //alert(document.cookie);

    $(".play").on("click", function () {

        $(this).css("display", "none");
        $(".pause").css("display", "block");
    });
    $(".pause").on("click", function () {
        $(this).css("display", "none");
        $(".play").css("display", "block");
    });
});