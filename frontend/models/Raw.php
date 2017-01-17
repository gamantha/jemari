<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "raw".
 *
 * @property string $hardware_id
 * @property string $pin
 * @property string $datetime
 * @property string $verified
 * @property string $status
 * @property string $workcode
 */
class Raw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pin', 'datetime', 'verified', 'status', 'workcode'], 'required'],
            [['datetime'], 'safe'],
            [['hardware_id', 'pin', 'verified', 'status', 'workcode'], 'string', 'max' => 50],
            [['pin', 'datetime', 'verified', 'status', 'workcode'], 'unique', 'targetAttribute' => ['pin', 'datetime', 'verified', 'status', 'workcode'], 'message' => 'The combination of Pin, Datetime, Verified, Status and Workcode has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hardware_id' => Yii::t('app', 'Hardware ID'),
            'pin' => Yii::t('app', 'Pin'),
            'datetime' => Yii::t('app', 'Datetime'),
            'verified' => Yii::t('app', 'Verified'),
            'status' => Yii::t('app', 'Status'),
            'workcode' => Yii::t('app', 'Workcode'),
        ];
    }

    /**
     * @inheritdoc
     * @return RawQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RawQuery(get_called_class());
    }
}
