<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\modules\attendance\models\ExtraAttendance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="extra-attendance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>



    <?php
echo 'Datetime';
    echo DatePicker::widget([
    'name'  => 'datetime',
    'attribute' => 'datetime',
    'model' => $model,
    'value'  => '',
    'options'=>['class' => 'form-control'],
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
]);

?>



    <?= $form->field($model, 'kehadiran')->textInput() ?>

    <?= $form->field($model, 'sakit')->textInput() ?>

    <?= $form->field($model, 'ijin')->textInput() ?>

    <?= $form->field($model, 'cuti')->textInput() ?>

    <?= $form->field($model, 'alpa')->textInput() ?>


        <?= $form->field($model, 'status')->textInput(['value'=>'active','readonly'=> true,'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
