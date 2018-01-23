<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\attendance\models\ExtraAttendanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="extra-attendance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nik') ?>

    <?= $form->field($model, 'datetime') ?>

    <?= $form->field($model, 'kehadiran') ?>

    <?= $form->field($model, 'sakit') ?>

    <?php // echo $form->field($model, 'ijin') ?>

    <?php // echo $form->field($model, 'cuti') ?>

    <?php // echo $form->field($model, 'alpa') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
