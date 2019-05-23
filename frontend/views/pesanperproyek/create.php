<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PesanPerproyek */

$this->title = Yii::t('app', 'Create Pesan Perproyek');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pesan Perproyeks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pesan-perproyek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
