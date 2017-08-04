<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/2
 * Time: 上午11:15
 */

namespace zacksleo\yii2\lookup\tests;

use zacksleo\yii2\lookup\models\Lookup;

class LookupModelTest extends TestCase
{

    public function testRules()
    {
        $model = new Lookup();
        $model->type = '1';
        $model->name = 'i am test';
        $model->code = 1;
        $model->active = 1;
        $this->assertFalse($model->save(),'property order is not set');
        $model->order = 1;
        $this->assertTrue($model->save(),'add success');
    }

    public function testItems()
    {
        $model = new Lookup();
        $model->type = '1';
        $model->name = 'i am test';
        $model->code = 1;
        $model->active = 1;
        $model->order = 1;
        $model->save();
        $res = Lookup::items($model->type);
        $this->assertTrue($res['1'] == $model->name,'find success');
    }

    public function testItem()
    {
        $model = new Lookup();
        $model->type = '2';
        $model->name = 'i am testItem';
        $model->code = 2;
        $model->active = 1;
        $model->order = 1;
        $model->save();
        $res = Lookup::item($model->type, $model->code);
        $this->assertTrue($res == $model->name,'add success');
    }

    public function testDelete()
    {
        $model = Lookup::findOne(['id'=>1]);
        if($model->id >0 ){
            $model->delete();
        }
        $model = Lookup::findOne(['id'=>1]);
        $this->assertTrue(empty($model), 'delete error');
    }

    public function testUpdate()
    {
        $model = Lookup::findOne(['id'=>1]);
        $model->name = "i am updated";
        $model->save();
        $find = Lookup::findOne(['id'=>1]);
        $this->assertTrue($find->name == $model->name, 'update error');
    }
}
