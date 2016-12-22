<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RawSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="raw-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'hardware_id') ?>

    <?= $form->field($model, 'pin') ?>

    <?= $form->field($model, 'datetime') ?>

    <?= $form->field($model, 'verified') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'workcode') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
