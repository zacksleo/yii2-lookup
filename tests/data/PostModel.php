<?php

namespace zacksleo\yii2\lookup\tests\data;

use yii\db\ActiveRecord;

/**
 * Class PostModel
 *
 * @package yii2mod\comments\tests\data
 */
class PostModel extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
        ];
    }
}