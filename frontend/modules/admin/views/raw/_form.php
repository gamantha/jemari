<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Raw */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="raw-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hardware_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pin')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'verified')->textInput(['value'=>0,'readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['value'=>0,'readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'workcode')->textInput(['value'=>99,'readonly' => true,'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
