<?php

namespace zacksleo\yii2\lookup\tests\data;
/**
 * Class Controller
 *
 * @package zacksleo\yii2\lookup\tests\data
 */
class Controller extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function render($view, $params = [])
    {
        return [
            'view' => $view,
            'params' => $params,
        ];
    }
}
