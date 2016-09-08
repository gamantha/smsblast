<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Customer;
/* @var $this yii\web\View */
/* @var $model app\models\ContactInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-info-form">

    <?php $form = ActiveForm::begin(); ?>

<?php $dataList=ArrayHelper::map(Customer::find()->asArray()->all(), 'id', 'nama');?>
	 <?=$form->field($model, 'customer_id')->dropDownList($dataList,
         ['prompt'=>'-Pilih Penyimpanan-'])->label('Customer') ?>
    
    <?= $form->field($model, 'sms')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
