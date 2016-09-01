<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Customer;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PesanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pesan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pesan', ['create'], ['class' => 'btn btn-success']) ?>
        
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'isi_pesan',
            'status',
            [
              'label' => 'Proyek ID',
              //'filter' => ArrayHelper::map(Customer::find()->asArray()->All(), 'id', 'proyek_id'),
              'value'=>function($data) {return $data->customer->proyek_id;},
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
