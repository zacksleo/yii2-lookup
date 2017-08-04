<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/2
 * Time: 上午11:15
 */

namespace zacksleo\yii2\lookup\tests;

use zacksleo\yii2\lookup\models\LookupSearch;

class LookupSearchModelTest extends TestCase
{

    public function testSearch()
    {
        $lookupSearch = new LookupSearch();
        $data = ['order' => 1];
        $res = $lookupSearch->search(['LookupSearch' => $data]);
        $this->assertTrue(1 == $res->query->count(), 'search error');
    }

    public function testModule()
    {
        $module = \Yii::$app->getModule('lookup');
        $module->init();
    }
}
