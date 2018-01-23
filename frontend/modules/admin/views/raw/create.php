<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Raw */

$this->title = Yii::t('app', 'Create Raw');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Raws'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
