<?php

namespace app\modules\attendance\models;

/**
 * This is the ActiveQuery class for [[UserSchedule]].
 *
 * @see UserSchedule
 */
class UserScheduleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UserSchedule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserSchedule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
