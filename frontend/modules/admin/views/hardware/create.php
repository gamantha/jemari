<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Hardware */

$this->title = Yii::t('app', 'Create Hardware');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hardwares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hardware-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
