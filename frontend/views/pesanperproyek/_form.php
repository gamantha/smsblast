<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PesanPerproyek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pesan-perproyek-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'proyek_id')->textInput() ?>

    <?= $form->field($model, 'isi_pesan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'undelivered' => 'Undelivered', 'delivered' => 'Delivered', 'recurring' => 'Recurring', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
