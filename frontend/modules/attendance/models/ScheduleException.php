<?php

namespace app\modules\attendance\models;

use Yii;

/**
 * This is the model class for table "schedule_exception".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property string $datetime
 * @property string $exception_type
 * @property string $exception_reason
 * @property string $status
 *
 * @property Employee $employee
 */
class ScheduleException extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule_exception';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'employee_id'], 'integer'],
            [['datetime'], 'safe'],
            [['exception_reason'], 'string'],
            [['exception_type', 'status'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'datetime' => Yii::t('app', 'Datetime'),
            'exception_type' => Yii::t('app', 'Exception Type'),
            'exception_reason' => Yii::t('app', 'Exception Reason'),
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
     * @inheritdoc
     * @return ScheduleExceptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ScheduleExceptionQuery(get_called_class());
    }
}
