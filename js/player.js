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
    $(".em1").on("click",function(){
        $(this).css("display","none");
        $(".divnever").css("display","block");
        $(".divnever").append("<input type='hidden' value=1 name='never'>");
        $(".em5").css("display","none");
        var em1=$(".em4")[0];
        var em2=$(".em3")[0];
        var em3=$(".em2")[0];
        $(".em52")[0].appendChild(em1);
        $(".em42")[0].appendChild(em2);
        $(".em32")[0].appendChild(em3);





    })
  $(".row1").on("click",function(){
      $(".row2").css("display","block");
  })
});