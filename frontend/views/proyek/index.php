<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyekSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyeks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyek-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Proyek', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama_proyek',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
