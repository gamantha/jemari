<?php

namespace app\modules\attendance\models;

/**
 * This is the ActiveQuery class for [[ExtraAttendance]].
 *
 * @see ExtraAttendance
 */
class ExtraAttendanceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ExtraAttendance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ExtraAttendance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
