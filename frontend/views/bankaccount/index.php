<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BankAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bank Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bank Account', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'bank_name',
            'virtual_account_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
