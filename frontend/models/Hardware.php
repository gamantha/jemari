<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hardware".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $location
 * @property string $ip_address
 * @property string $ip_port
 * @property string $key
 */
class Hardware extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hardware';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 50],
            [['name', 'description', 'location', 'ip_address', 'ip_port', 'key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'location' => Yii::t('app', 'Location'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'ip_port' => Yii::t('app', 'Ip Port'),
            'key' => Yii::t('app', 'Key'),
        ];
    }

    /**
     * @inheritdoc
     * @return HardwareQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HardwareQuery(get_called_class());
    }
}
