<?php

use yii\helpers\Html;
use zacksleo\yii2\lookup\Module;

/* @var $this yii\web\View */
/* @var $model app\models\Lookup */

$this->title = Module::t('core', 'Update Lookup') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('core', 'Lookups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lookup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
