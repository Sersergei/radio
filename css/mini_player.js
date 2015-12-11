var y;
$(document).ready(function(){


    if(document.cookie !== "visited") {
        document.cookie = "visited";
       // window.location = self.location;
    }
    $(".mini_controls .mini-play").on("click",function(){

        $(".mini_controls .mini-pause").hide();
       // $(".mini-play:hidden").parent().next().children(audio);
        $(".mini_controls .mini-play").show();
        $(this).hide();
        $( this ).next(".mini-pause").show();
    });
    $(".mini_controls .mini-pause").on("click",function(){
        $(this).css("display","none");
        $(".mini_controls .mini-pause").hide();
        $(".mini_controls .mini-play").show();
    });





    //Громкость RADIO
    $( "#slider" ).slider({
        range: "min",
        value: 50,
        orientation: "horizontal",
        animate: true,
        step: 1,
        min: 1,
        max: 100,
        change : function(){
            var value = $("#slider").slider("value");
            document.getElementById("player").volume = (value / 100);
        }
    });

    //ТЕКУЩИЙ ТРЕК (ПРОИГРУЕТСЯ)

});
function play (x){
    if (y!==undefined){
        y.pause();
    }

    x.play();
    y=x;
}