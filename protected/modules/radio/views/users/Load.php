<?php echo Yii::t('radio','????????? exel ???? ??? ???????? ????? ?????????????') ?></p>
<?php
echo CHtml::form('','POST',array('enctype'=>'multipart/form-data'));
echo CHtml::activeFileField($model, 'document');
echo CHtml::error($model,'document');
echo CHtml::submitButton( 'Import');
echo CHtml::endForm();
?>
<br>
<?php echo Yii::t('radio','��������� ').$coun.Yii::t('radio','�������');
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
