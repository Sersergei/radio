$(document).ready(function(){


    if(document.cookie !== "visited") {
        document.cookie = "visited";
       // window.location = self.location;
    }
    $(".mini_controls .mini-play").on("click",function(){
        $(this).css("display","none");
        $(".mini_controls .mini-pause").css("display", "block");
    });
    $(".mini_controls .mini-pause").on("click",function(){
        $(this).css("display","none");
        $(".mini_controls .mini-play").css("display", "block");
    });

    //Переключение потоков DANCE_RADIO
    $(".low_stream_dance").on("click", function() {
        $(".dance_player").attr("src", "http://live.eradio.ua/e-dance_acc");
        $(".qr_code").attr("src","../image/qr_codes/e-dance_low.gif");
        $(".control .play").click();
    });
    $(".high_stream_dance").on("click", function() {
        $(".dance_player").attr("src", "http://live.eradio.ua/e-dance_hi");
        $(".qr_code").attr("src","../image/qr_codes/e-dance_hi.gif");
        $(".control .play").click();
    });

    //Переключение потоков HIT_RADIO
    $(".low_stream_hit").on("click", function() {
        $(".hit_player").attr("src", "http://live.eradio.ua/e-hit_acc");
        $(".qr_code").attr("src","../image/qr_codes/e-hit_low.gif");
        $(".control .play").click();
    });
    $(".high_stream_hit").on("click", function() {
        $(".hit_player").attr("src", "http://live.eradio.ua/e-hit_hi");
        $(".qr_code").attr("src","../image/qr_codes/e-hit_hi.gif");
        $(".control .play").click();
    });

    //Переключение потоков ROCK_RADIO
    $(".low_stream_rock").on("click", function() {
        $(".rock_player").attr("src", "http://live.eradio.ua/e-rock_acc");
        $(".qr_code").attr("src","../image/qr_codes/eradio_rock_low.gif");
        $(".control .play").click();
    });
    $(".high_stream_rock").on("click", function() {
        $(".rock_player").attr("src", "http://live.eradio.ua/e-rock_hi");
        $(".qr_code").attr("src","../image/qr_codes/eradio_rock_hi.gif");
        $(".control .play").click();
    });

    //Переключение потоков UA_RADIO
    $(".low_stream_ua").on("click", function() {
        $(".ua_player").attr("src", "http://live.eradio.ua/e-rock_acc");
        $(".qr_code").attr("src","../image/qr_codes/eradio_low.gif");
        $(".control .play").click();
    });
    $(".high_stream_ua").on("click", function() {
        $(".ua_player").attr("src", "http://live.eradio.ua/e-rock_hi");
        $(".qr_code").attr("src","../image/qr_codes/eradio_hi.gif");
        $(".control .play").click();
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
    setInterval(function(){
        $.ajax({
            type: "POST",
            url: "../now_play_mini.php",

            success: function(data){
                console.log(data);
                var res = eval('(' + data + ')');

                $(".artist_name_ua").text(res['ARTIST_NAME_UA']);
                $(".song_name_ua").text(res['TRACK_SONG_UA']);
                if (res['PICTURE_UA'] == '\r\n'){
                    var srcPictUa = "../i/_noname.jpg";
                } else {
                    var srcPictUa = "../i/"+res['PICTURE_UA'];
                }
                $(".artist_picture_ua").attr("src", srcPictUa);

                $(".artist_name_rock").text(res['ARTIST_NAME_ROCK']);
                $(".song_name_rock").text(res['TRACK_SONG_ROCK']);
                if (res['PICTURE_ROCK'] == '\r\n'){
                    var srcPictRock = "../i/_noname.jpg";
                } else {
                    var srcPictRock = "../i/"+res['PICTURE_ROCK'];
                }
                $(".artist_picture_rock").attr("src", srcPictRock);

                $(".artist_name_dance").text(res['ARTIST_NAME_DANCE']);
                $(".song_name_dance").text(res['TRACK_SONG_DANCE']);
                if (res['PICTURE_DANCE'] == '\r\n'){
                    var srcPictDance = "../i/_noname.jpg";
                } else {
                    var srcPictDance = "../i/"+res['PICTURE_DANCE'];
                }
                $(".artist_picture_dance").attr("src", srcPictDance);

                $(".artist_name_hit").text(res['ARTIST_NAME_HIT']);
                $(".song_name_hit").text(res['TRACK_SONG_HIT']);
                if (res['PICTURE_HIT'] == '\r\n'){
                    var srcPictHit = "../i/_noname.jpg";
                } else {
                    var srcPictHit = "../i/"+res['PICTURE_HIT'];
                }
                $(".artist_picture_hit").attr("src", srcPictHit);
            }
        });
    },1000);
});
