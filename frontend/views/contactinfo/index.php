<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Customer;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contact Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'customer_id',
            [
             'attribute' => 'id',
             'label'=>'Nama Customer',
			  //'filter'=>array('1'=>'PROD','2'=>'KU','3'=>'LG','4'=>'MRK','5'=>'PRC','6'=>'UM'),
             'filter' => ArrayHelper::map(Customer::find()->asArray()->All(), 'id', 'nama'),
             'value'=>function($data) {return $data->customer->nama;},
           ],
            'sms',
            'email:email',
            'address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
