/**
 * Created by ������ on 11.12.2015.
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
    $(".em1").on("click",function(){
        $(this).css("display","none");
        $(".divnever").css("display","block");
        $(".divnever").append("<input type='hidden' value=1 name='never'>");
        $(".em5").css("display","none");

    })
  $(".row1").on("click",function(){
      $(".row2").css("display","block");
  })
});