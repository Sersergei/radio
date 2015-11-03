<?php
/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 03.11.2015
 * Time: 12:36
 */
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'config-form',
    'enableAjaxValidation' => false, // Ajax- и Client- валидацию я не предусматривал, т.к. это не имеет смысла
    'enableClientValidation' => false,
));
foreach ($model->attributeNames() as $attribute) {
    echo CHtml::openTag('div', array('class' => 'row'));
    {
        echo $form->labelEx($model, $attribute);
        echo $form->textField($model, $attribute);
    }
    echo CHtml::closeTag('div');
}
echo CHtml::submitButton('Сохранить');
$this->endWidget();