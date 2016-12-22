<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hardware */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Hardware',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hardwares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="hardware-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
