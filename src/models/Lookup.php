<?php

namespace zacksleo\yii2\lookup\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use zacksleo\yii2\lookup\Module;

/**
 * This is the model class for table "lookup".
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property integer $code
 * @property string $comment
 * @property integer $active
 * @property integer $order
 * @property integer $created_at
 * @property integer $updated_at
 */
class Lookup extends ActiveRecord
{
    private static $_items = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lookup}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'code', 'active', 'order'], 'required'],
            [['code', 'active', 'order', 'created_at', 'updated_at'], 'integer'],
            [['comment'], 'string'],
            [['type', 'name'], 'string', 'max' => 100],
            [['type', 'name'], 'unique', 'targetAttribute' => ['type', 'name'], 'message' => Module::t('core', 'The combination of Type and Name has already been taken.')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('core', 'ID'),
            'type' => Module::t('core', 'Type'),
            'name' => Module::t('core', 'Name'),
            'code' => Module::t('core', 'Code'),
            'comment' => Module::t('core', 'Comment'),
            'active' => Module::t('core', 'Active'),
            'order' => Module::t('core', 'Order'),
            'created_at' => Module::t('core', 'Created At'),
            'updated_at' => Module::t('core', 'Updated At'),
        ];
    }

    /**
     * Returns the items for the specified type.
     * @param string item type (e.g. 'PostStatus').
     * @return array item names indexed by item code. The items are order by their order values.
     * An empty array is returned if the item type does not exist.
     */
    public static function items($type)
    {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type);
        }
        return self::$_items[$type];
    }

    /**
     * Returns the item name for the specified type and code.
     * @param string the item type (e.g. 'PostStatus').
     * @param integer the item code (corresponding to the 'code' column value)
     * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
     */
    public static function item($type, $code)
    {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type);
        }
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }

    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    private static function loadItems($type)
    {
        self::$_items[$type] = array();
        $models = self::find()
            ->where([
                'type' => $type,
                'active' => 1,
            ])
            ->orderBy('order')
            ->all();

        foreach ($models as $model) {
            self::$_items[$type][$model->code] = $model->name;
        }
    }
}
