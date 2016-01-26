<?php echo Yii::t('radio','For add users in base we must upload excel file (A column - user name, B column - email)') ?></p>
<?php
echo CHtml::form('','POST',array('enctype'=>'multipart/form-data'));
echo CHtml::activeFileField($model, 'document');
echo CHtml::error($model,'document');
echo CHtml::submitButton( 'Import');
echo CHtml::endForm();
?>
<br>
<?php if($coun) echo Yii::t('radio','add users ').$coun;
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

        echo '<tr>';
        echo '<td>'.$user->name_listener.'</td>';
        echo '<td>'.$user->email.'</td>';
        echo '<td>'.$user->getErrors()["email"][0].'</td></tr>';
    }
    ?>
</table>
<?php } ?>
