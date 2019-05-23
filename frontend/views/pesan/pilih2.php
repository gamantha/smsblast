<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Customer;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<p>
	    <?= $form->field($pesanproyek, 'isi_pesan')->textInput(['maxlength' => true]) ?>
</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'proyek_id',

  ['class' => 'yii\grid\CheckboxColumn'],
        ],
    ]); ?>



    <div class="form-group">
        <?= Html::submitButton($pesanproyek->isNewRecord ? 'Create' : 'Update', ['class' => $pesanproyek->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>

