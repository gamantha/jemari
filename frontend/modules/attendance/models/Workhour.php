<?php

namespace app\modules\attendance\models;

use Yii;

/**
 * This is the model class for table "workhour".
 *
 * @property integer $id
 * @property string $name
 * @property string $start_scan
 * @property string $end_scan
 * @property string $ontime
 * @property string $pretime_value
 * @property string $posttime_value
 * @property string $label
 *
 * @property ScheduleItem[] $scheduleItems
 */
class Workhour extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workhour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_scan', 'end_scan', 'ontime'], 'safe'],
            [['name', 'pretime_value', 'posttime_value', 'label'], 'string', 'max' => 255],
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
            'start_scan' => Yii::t('app', 'Start Scan'),
            'end_scan' => Yii::t('app', 'End Scan'),
            'ontime' => Yii::t('app', 'Ontime'),
            'pretime_value' => Yii::t('app', 'Pretime Value'),
            'posttime_value' => Yii::t('app', 'Posttime Value'),
            'label' => Yii::t('app', 'Label'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheduleItems()
    {
        return $this->hasMany(ScheduleItem::className(), ['workhour_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return WorkhourQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkhourQuery(get_called_class());
    }
}
