<?php

namespace yii2mod\comments\tests;

use Yii;
use yii\helpers\Json;
use zacksleo\yii2\lookup\models\Lookup;
use zacksleo\yii2\lookup\Module;
use zacksleo\yii2\lookup\controllers\DefaultController;
use zacksleo\yii2\lookup\tests\data\PostModel;
use zacksleo\yii2\lookup\tests\TestCase;

/**
 * Class CommentTest
 *
 * @package zacksleo\yii2\lookup\tests
 */
class LookupTest extends TestCase
{
    public function testAddComment()
    {
        Yii::$app->request->bodyParams = [
            'Lookup' => [
                'type' => 'TestStatus',
                'name' => '测试中',
                'code' => 3,
                'order' => 3,
                'active' => 1,
            ],
        ];
        $response = Yii::$app->runAction('lookup/default/create', ['entity' => $this->generateEntity()]);
        $this->assertEquals('success', $response['status'], 'Unable to add a comment!');
    }

    /**
     * Generate entity string
     *
     * @return string
     */
    private function generateEntity()
    {
        $post = PostModel::find()->one();

        return utf8_encode(Yii::$app->getSecurity()->encryptByKey(Json::encode([
            'entity' => hash('crc32', get_class($post)),
            'entityId' => $post->id,
            'relatedTo' => get_class($post) . ':' . $post->id,
        ]), 'lookup'));
    }
}
