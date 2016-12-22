<?php

namespace app\modules\attendance\models;

/**
 * This is the ActiveQuery class for [[ScheduleItem]].
 *
 * @see ScheduleItem
 */
class ScheduleItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ScheduleItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ScheduleItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
