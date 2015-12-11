
<h1></h1>
<div class="lm-inner clearfix">
    <div class="controls">
        <a href="javascript:void(0)" class="play" style="display: block;" onclick="document.getElementById('player').play()"></a>
        <a href="javascript:void(0)" class="pause " style="display: none;" onclick="document.getElementById('player').pause()"></a>
    </div>
    <div class="lm-track lmtr-top">
        <audio id="player" class="track_player" src="<?php echo $song ?>"></audio>
    </div>
</div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>