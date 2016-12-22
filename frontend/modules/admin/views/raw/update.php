<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Raw */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Raw',
]) . $model->pin;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Raws'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pin, 'url' => ['view', 'pin' => $model->pin, 'datetime' => $model->datetime, 'verified' => $model->verified, 'status' => $model->status, 'workcode' => $model->workcode]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="raw-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
