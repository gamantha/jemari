<?php

namespace app\modules\attendance\models;

use Yii;

/**
 * This is the model class for table "user_schedule".
 *
 * @property integer $employee_id
 * @property integer $schedule_set_id
 * @property string $start_period
 * @property string $end_period
 * @property integer $order
 * @property string $status
 *
 * @property Employee $employee
 * @property ScheduleSet $scheduleSet
 */
class UserSchedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'schedule_set_id', 'start_period', 'end_period', 'status'], 'required'],
            [['employee_id', 'schedule_set_id', 'order'], 'integer'],
            [['start_period', 'end_period'], 'safe'],
            [['status'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['schedule_set_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScheduleSet::className(), 'targetAttribute' => ['schedule_set_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => Yii::t('app', 'Employee ID'),
            'schedule_set_id' => Yii::t('app', 'Schedule Set ID'),
            'start_period' => Yii::t('app', 'Start Period'),
            'end_period' => Yii::t('app', 'End Period'),
            'order' => Yii::t('app', 'Order'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheduleSet()
    {
        return $this->hasOne(ScheduleSet::className(), ['id' => 'schedule_set_id']);
    }
}
