<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Hardware]].
 *
 * @see Hardware
 */
class HardwareQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Hardware[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Hardware|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
