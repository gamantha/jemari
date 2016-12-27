<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\attendance\models\ExtraAttendance */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Extra Attendance',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Extra Attendances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="extra-attendance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
