<?php

namespace app\modules\attendance\models;

/**
 * This is the ActiveQuery class for [[EmployeeSchedule]].
 *
 * @see EmployeeSchedule
 */
class EmployeeScheduleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return EmployeeSchedule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EmployeeSchedule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
