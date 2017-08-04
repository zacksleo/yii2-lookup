<?php

namespace zacksleo\yii2\lookup\tests;

use Yii;
use yii\helpers\ArrayHelper;
use zacksleo\yii2\lookup\tests\data\Controller;

/**
 * This is the base class for all yii framework unit tests.
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->mockWebApplication();
        $this->createTestDbData();
    }

    protected function tearDown()
    {
        $this->destroyTestDbData();
        $this->destroyApplication();
    }

    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     *
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected function mockApplication($config = [], $appClass = '\yii\web\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' =>  __DIR__ ,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'sqlite::memory:'
                ],
                'i18n' => [
                    'translations' => [
                        '*' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                        ]
                    ]
                ],
            ],
            'modules'=>[
                'lookup'=>[
                    'class'=>'zacksleo\yii2\lookup\Module',
                    'layout'=>'@tests/layouts/main'
                ]
            ]
        ], $config));
    }

    protected function mockWebApplication($config = [], $appClass = '\yii\web\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'sqlite::memory:'
                ],
                'i18n' => [
                    'translations' => [
                        '*' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                        ]
                    ]
                ],
            ],
            'modules'=>[
                'lookup'=>[
                    'class'=>'zacksleo\yii2\lookup\Module',
                ]
            ]
        ], $config));
    }

    /**
     * @return string vendor path
     */
    protected function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        if (\Yii::$app && \Yii::$app->has('session', true)) {
            \Yii::$app->session->close();
        }
        \Yii::$app = null;
    }

    protected  function destroyTestDbData(){


    }

    protected function createTestDbData()
    {
        $db = Yii::$app->getDb();

        $db->createCommand()->createTable('lookup', [
            'id' => 'pk',
            'type' => 'string not null',
            'name' => 'string not null',
            'code' => 'integer not null default 1',
            'comment' => 'text',
            'active' => 'smallint default 1',
            'order' => 'integer not null default 0',
            'created_at' => 'integer not null default 0',
            'updated_at' => 'integer default 0',
        ])->execute();
        $db->createCommand()->insert('lookup', [
            'type' => 'TestStatus',
            'name' => '成功',
            'code' => 1,
            'active' => 1,
            'order' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ])->execute();
        $db->createCommand()->insert('lookup', [
            'type' => 'TestStatus',
            'name' => '失败',
            'code' => 2,
            'active' => 1,
            'order' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ])->execute();
        $db->createCommand()->createTable('post', [
            'id' => 'pk',
            'title' => 'string not null',
            'description' => 'string not null',
            'created_at' => 'integer not null default 0',
            'updated_at' => 'integer default 0',
        ])->execute();
        $db->createCommand()->insert('post', [
            'title' => 'title',
            'description' => 'description',
            'created_at' => time(),
            'updated_at' => time(),
        ])->execute();
    }
}
