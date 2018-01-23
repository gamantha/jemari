<?php

namespace app\modules\attendance\models;

/**
 * This is the ActiveQuery class for [[ScheduleSet]].
 *
 * @see ScheduleSet
 */
class ScheduleSetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ScheduleSet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ScheduleSet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
