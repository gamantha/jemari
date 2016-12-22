<?php

namespace app\modules\attendance\models;

use Yii;

/**
 * This is the model class for table "schedule_item".
 *
 * @property integer $schedule_set_id
 * @property integer $dayofweek
 * @property integer $workhour_id
 * @property string $optional
 *
 * @property Exception[] $exceptions
 * @property Exception[] $exceptions0
 * @property Exception[] $exceptions1
 * @property ScheduleSet $scheduleSet
 * @property Workhour $workhour
 */
class ScheduleItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['schedule_set_id', 'dayofweek', 'workhour_id'], 'required'],
            [['schedule_set_id', 'dayofweek', 'workhour_id'], 'integer'],
            [['optional'], 'string', 'max' => 255],
            [['schedule_set_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScheduleSet::className(), 'targetAttribute' => ['schedule_set_id' => 'id']],
            [['workhour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Workhour::className(), 'targetAttribute' => ['workhour_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'schedule_set_id' => Yii::t('app', 'Schedule Set ID'),
            'dayofweek' => Yii::t('app', 'Dayofweek'),
            'workhour_id' => Yii::t('app', 'Workhour ID'),
            'optional' => Yii::t('app', 'Optional'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExceptions()
    {
        return $this->hasMany(Exception::className(), ['schedule_set_id' => 'schedule_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExceptions0()
    {
        return $this->hasMany(Exception::className(), ['workhour_id' => 'workhour_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExceptions1()
    {
        return $this->hasMany(Exception::className(), ['schedule_set_id' => 'schedule_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheduleSet()
    {
        return $this->hasOne(ScheduleSet::className(), ['id' => 'schedule_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkhour()
    {
        return $this->hasOne(Workhour::className(), ['id' => 'workhour_id']);
    }

    /**
     * @inheritdoc
     * @return ScheduleItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ScheduleItemQuery(get_called_class());
    }
}
