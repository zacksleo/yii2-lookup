<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\lookup\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\lookup\models\Lookup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('core', 'Lookups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('core', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('core', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('core', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'name',
            'code',
            'comment:ntext',
            [
                'attribute' => 'active',
                'value' => ($model->active == '1') ? Module::t('core', 'Yes') : Module::t('core', 'No'),
            ],
            'sort_order',
            'created_at:datetime',
            'updated_at:datetime'
        ],
    ]) ?>

</div>
