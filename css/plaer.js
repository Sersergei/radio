/**
 * Created by Сергей on 06.12.2015.
 */
function player() {
    if (audioTrack.paused) {
        setText(this, "Pause");
        audioTrack.play();
    } else {
        setText(this,"Play");
        audioTrack.pause();
    }
}
function setText(el,text) {
    el.innerHTML = text;
}
function setAttributes(el, attrs) {
    for(var key in attrs){
        el.setAttribute(key, attrs[key]);
    }
}
var audioPlayer = document.getElementById("audioplayer"),
    fader = document.getElementById("fader"),
    playback = document.getElementById("playback"),
    audioTrack = document.getElementById("audiotrack"),
    playButton = document.createElement("button"),
    muteButton = document.createElement("button"),
    playhead = document.createElement("progress")
volumeSlider = document.createElement("input");
setText(playButton, "Play");
playback.appendChild(playButton);
audioTrack.removeAttribute("controls");
playButton.addEventListener("click", player, false);
