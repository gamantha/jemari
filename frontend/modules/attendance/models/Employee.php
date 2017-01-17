<?php

namespace app\modules\attendance\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property string $pin
 * @property string $nik
 * @property string $status
 *
 * @property ScheduleException[] $scheduleExceptions
 * @property UserSchedule[] $userSchedules
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['pin', 'nik', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pin' => Yii::t('app', 'Pin'),
            'nik' => Yii::t('app', 'Nik'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheduleExceptions()
    {
        return $this->hasMany(ScheduleException::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSchedules()
    {
        return $this->hasMany(UserSchedule::className(), ['employee_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery(get_called_class());
    }
}
