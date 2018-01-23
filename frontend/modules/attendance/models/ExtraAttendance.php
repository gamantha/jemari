<?php

namespace app\modules\attendance\models;

use Yii;

/**
 * This is the model class for table "extra_attendance".
 *
 * @property integer $id
 * @property string $nik
 * @property string $datetime
 * @property integer $kehadiran
 * @property integer $sakit
 * @property integer $ijin
 * @property integer $cuti
 * @property integer $alpa
 * @property string $status
 */
class ExtraAttendance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'extra_attendance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datetime'], 'safe'],
            [['kehadiran', 'sakit', 'ijin', 'cuti', 'alpa'], 'integer'],
            [['nik', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nik' => Yii::t('app', 'Nik'),
            'datetime' => Yii::t('app', 'Datetime'),
            'kehadiran' => Yii::t('app', 'Kehadiran'),
            'sakit' => Yii::t('app', 'Sakit'),
            'ijin' => Yii::t('app', 'Ijin'),
            'cuti' => Yii::t('app', 'Cuti'),
            'alpa' => Yii::t('app', 'Alpa'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return ExtraAttendanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExtraAttendanceQuery(get_called_class());
    }
}
