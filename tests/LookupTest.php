<?php

namespace zacksleo\yii2\lookup\tests;

use Yii;

use yii\helpers\Json;
use zacksleo\yii2\lookup\models\Lookup;
use zacksleo\yii2\lookup\tests\data\PostModel;


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
        $this->assertEquals('Found', $response->statusText, 'Unable to add a comment!');
    }

    public function testUpdateComment()
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
        $response = Yii::$app->runAction('lookup/default/update', ['id'=>1,'entity' => $this->generateEntity()]);
        $this->assertEquals('Found', $response->statusText, 'Unable to add a comment!');
    }

    public function testView()
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
        $response = Yii::$app->runAction('lookup/default/view', ['id'=>1]);
        $res = preg_match('/<h1>成功<\/h1>/', $response, $matches);
        $this->assertEquals(1, $res, 'Unable to add find the view!');
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
