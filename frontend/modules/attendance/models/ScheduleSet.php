<?php

namespace app\modules\attendance\models;

use Yii;

/**
 * This is the model class for table "schedule_set".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ScheduleItem[] $scheduleItems
 * @property UserSchedule[] $userSchedules
 */
class ScheduleSet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheduleItems()
    {
        return $this->hasMany(ScheduleItem::className(), ['schedule_set_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSchedules()
    {
        return $this->hasMany(UserSchedule::className(), ['schedule_set_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ScheduleSetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ScheduleSetQuery(get_called_class());
    }
}
