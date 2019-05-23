<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Proyek */

$this->title = 'Create Proyek';
$this->params['breadcrumbs'][] = ['label' => 'Proyeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
