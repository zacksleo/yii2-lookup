<?php

use yii\helpers\Html;
use yii\grid\GridView;
use zacksleo\yii2\lookup\Module;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('core', 'Lookups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('core', 'Create Lookup'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $lookupModel,
        'tableOptions' => ['class' => 'table table-hover table-striped table-condensed'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'type',
            'name',
            'code',
            //'comment:ntext',
            [
                'attribute' => 'active',
                'value' => function ($model, $key) {
                    return ($model->active == '1') ? Module::t('core', 'Yes') : Module::t('core', 'No');
                },
                'filter' => ['1' => Module::t('core', 'Yes'), '2' => Module::t('core', 'No')],
            ],
            'sort_order',
            // 'created_at',
            // 'created_by',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
