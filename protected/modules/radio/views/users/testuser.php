<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'users-grid',
    'dataProvider'=>$model->users(),

    'columns'=>array(

        array(
            'name' => 'song_name',
            'type' => 'raw',
            'value' => '$data->idSong->name',
        ),
        array(
            'name'=>'like',
            'type'=>'raw',
            'value'=>'$data->idLike->song_like'
        ),
        array(
            'name'=>'never',
            'type'=>'raw',
            'value'=>'$data->getnevers()',
        ),


    ),));