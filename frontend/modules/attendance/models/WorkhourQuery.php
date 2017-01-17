<?php

namespace app\modules\attendance\models;

/**
 * This is the ActiveQuery class for [[Workhour]].
 *
 * @see Workhour
 */
class WorkhourQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Workhour[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Workhour|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
