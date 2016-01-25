<?php echo Yii::t('radio','Загрузите exel файл с пользователями которых хотите добавить в систему') ?></p>
<?php
echo CHtml::form('','POST',array('enctype'=>'multipart/form-data'));
echo CHtml::activeFileField($model, 'document');
echo CHtml::error($model,'document');
echo CHtml::submitButton( 'Import');
echo CHtml::endForm();
?>
<br>
<?php if($coun) echo Yii::t('radio','Загружено ').$coun.Yii::t('radio','человек');
?>
<br>
<?php
if($error){
?>
<table>
    <tr>
        <td><?php echo Yii::t('radio','Name'); ?></td>
        <td><?php echo Yii::t('radio','Email'); ?></td>
        <td><?php echo Yii::t('radio','Error'); ?></td>
    </tr>
    <?php foreach($error as $user){
        echo '<td>'.$user->name_listner.'</td>';
        echo '<td>'.$user->email.'</td>';
        echo '<td>'.$user->error.'</td>';
    }
    ?>
</table>
<?php } ?>
