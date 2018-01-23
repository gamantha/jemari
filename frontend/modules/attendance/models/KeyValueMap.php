<?php

namespace app\modules\attendance\models;

use Yii;

/**
 * This is the model class for table "key_value_map".
 *
 * @property string $key
 * @property string $relation
 * @property string $value
 */
class KeyValueMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'key_value_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'relation', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('app', 'Key'),
            'relation' => Yii::t('app', 'Relation'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @inheritdoc
     * @return KeyValueMapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KeyValueMapQuery(get_called_class());
    }
}
