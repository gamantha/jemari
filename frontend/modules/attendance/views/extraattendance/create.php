<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\attendance\models\ExtraAttendance */

$this->title = Yii::t('app', 'Create Extra Attendance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Extra Attendances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extra-attendance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
