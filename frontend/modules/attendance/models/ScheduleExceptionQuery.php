<?php

namespace app\modules\attendance\models;

/**
 * This is the ActiveQuery class for [[ScheduleException]].
 *
 * @see ScheduleException
 */
class ScheduleExceptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ScheduleException[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ScheduleException|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
