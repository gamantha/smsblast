<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Customer;
/* @var $this yii\web\View */
/* @var $model app\models\Pesan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pesan-form">

    <?php $form = ActiveForm::begin(); ?>

<?php $dataList=ArrayHelper::map(Customer::find()->asArray()->all(), 'id', 'nama');?>
	 <?=$form->field($model, 'customer_id')->dropDownList($dataList,
         ['prompt'=>'-Pilih Penyimpanan-'])->label('Customer') ?>
    
    <?= $form->field($model, 'isi_pesan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'undelivered' => 'Undelivered', 'delivered' => 'Delivered', 'recurring' => 'Recurring', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
