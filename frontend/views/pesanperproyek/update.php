<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PesanPerproyek */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pesan Perproyek',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pesan Perproyeks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pesan-perproyek-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
