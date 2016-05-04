
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'music-test-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'name' => 'Name',
            'type' => 'raw',
            'value' => '$data->user->name_listener',
            'filter'=>false,
        ),
        array(
            'name' => 'email_fromm',
            'type' => 'raw',
            'value' => '$data->user->email',
        ),


        array(
            'name' => 'date',
            'type' => 'raw',
            'value' => '$data->date',
            'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'date',
                'language'=>Yii::app()->language,
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd',
                    'changeMonth' => 'true',
                    'changeYear'=>'true',
                ),
            ),true),
        ),

        array(
            'name' => 'message',
            'type' => 'raw',
            'value' => '$data->message',
        ),


    ),
)); ?>
<br>
<a href="?users=1&type=Excel2007">Download report Excel</a></br>

